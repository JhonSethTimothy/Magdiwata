<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    private $roomPrices = [
        'kubo-hut' => 500,
        'kubo-hut-premium' => 600
    ];

    private $entranceFeeAdult = 100;
    private $entranceFeeChild = 50;

    public function showBookingForm()
    {
        // Get available rooms grouped by type
        $availableRooms = [
            'standard' => Room::where('type', 'standard')->where('status', 'available')->get(),
            'premium' => Room::where('type', 'premium')->where('status', 'available')->get()
        ];

        $activities = [
            'paintball' => 'Paintball Battles',
            'rappelling' => 'Rappelling',
            'hiking' => 'Guided Hikes',
            'farm-tour' => 'Organic Farm Tours'
        ];

        return view('book', compact('availableRooms', 'activities'));
    }

    public function submitBooking(Request $request)
    {
        \Log::info('submitBooking called with data: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'room_type' => 'nullable|string',
            'room_date' => 'nullable|date|after_or_equal:today',
            'room_checkout' => 'nullable|date|after:room_date',
            'activity' => 'nullable|string',
            'activity_date' => 'nullable|date|after_or_equal:today',
            'adults' => 'required|integer|min:1|max:20',
            'children' => 'required|integer|min:0|max:20',
            'notes' => 'nullable|string',
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120' // 5MB max
        ]);

        // Validate that at least one booking type is selected
        if (!$request->room_type && !$request->activity) {
            return back()->withErrors(['booking_type' => 'Please select at least one room or activity to book.']);
        }

        // Validate that booking dates are not in the past
        $today = new \DateTime('today');
        if ($request->room_date) {
            $roomDate = new \DateTime($request->room_date);
            if ($roomDate < $today) {
                return back()->withErrors(['room_date' => 'Room booking date cannot be in the past.']);
            }
        }
        if ($request->room_checkout) {
            $roomCheckout = new \DateTime($request->room_checkout);
            if ($roomCheckout < $today) {
                return back()->withErrors(['room_checkout' => 'Room checkout date cannot be in the past.']);
            }
        }
        if ($request->activity_date) {
            $activityDate = new \DateTime($request->activity_date);
            if ($activityDate < $today) {
                return back()->withErrors(['activity_date' => 'Activity booking date cannot be in the past.']);
            }
        }

        // Handle file upload
        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receipt = $request->file('receipt');
            $receiptPath = $receipt->store('receipts', 'public');
        }

        // Create room booking if selected
        if ($request->room_id && $request->room_date) {
            // Start database transaction
            return DB::transaction(function () use ($request, $receiptPath, $today) {
                // Find and lock the room for update
                $room = Room::where('id', $request->room_id)
                    ->where('status', 'available')
                    ->lockForUpdate()
                    ->first();

                if (!$room) {
                    throw new \Exception('Selected room is not available. Please select another room.');
                }

                // Check if room is fully booked for the requested dates
                $roomDate = new \DateTime($request->room_date);
                if ($roomDate < $today) {
                    throw new \Exception('Room booking date cannot be in the past.');
                }
                if ($request->room_checkout) {
                    $roomCheckout = new \DateTime($request->room_checkout);
                    if ($roomCheckout < $today) {
                        throw new \Exception('Room checkout date cannot be in the past.');
                    }
                }

                $roomNotes = $request->notes;
                if ($request->room_checkout) {
                    $roomNotes = ($roomNotes ? $roomNotes . "\n" : "") . "Check-out date: " . $request->room_checkout;
                }

                $roomPrice = $room->type === 'premium' ? 600 : 500;
                $entranceFee = ($request->adults * $this->entranceFeeAdult) + ($request->children * $this->entranceFeeChild);

                // Calculate number of nights
                $checkin = new \DateTime($request->room_date);
                $checkout = $request->room_checkout ? new \DateTime($request->room_checkout) : null;
                $nights = 1;
                if ($checkout && $checkout > $checkin) {
                    $interval = $checkin->diff($checkout);
                    $nights = $interval->days;
                }

                $totalAmount = ($roomPrice * $nights) + $entranceFee;

                \Log::info('Calculated totalAmount for room booking: ' . $totalAmount);

                // Create the booking
                $booking = Booking::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'room_id' => $room->id,
                    'type' => 'room',
                    'booking_date' => $request->room_date,
                    'checkout_date' => $request->room_checkout,
                    'selection' => $room->type === 'premium' ? 'kubo-hut-premium' : 'kubo-hut',
                    'adults' => $request->adults,
                    'children' => $request->children,
                    'notes' => $roomNotes,
                    'total_amount' => $totalAmount,
                    'payment_method' => 'gcash',
                    'receipt_path' => $receiptPath,
                    'payment_status' => 'pending'
                ]);

                // Update room status
                $room->status = 'booked';
                $room->save();

                return $booking;
            });
        }

        // Create activity booking if selected
        if ($request->activity && $request->activity_date) {
            $entranceFee = ($request->adults * $this->entranceFeeAdult) + ($request->children * $this->entranceFeeChild);
            $totalAmount = $entranceFee;
            \Log::info('Calculated totalAmount for activity booking: ' . $totalAmount);

            Booking::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => 'activity',
                'booking_date' => $request->activity_date,
                'selection' => $request->activity,
                'adults' => $request->adults,
                'children' => $request->children,
                'notes' => $request->notes,
                'total_amount' => $totalAmount,
                'payment_method' => 'gcash',
                'receipt_path' => $receiptPath,
                'payment_status' => 'pending'
            ]);
        }

        $bookingTypes = [];
        if ($request->room_type) $bookingTypes[] = 'room';
        if ($request->activity) $bookingTypes[] = 'activity';

        $bookingTypeText = implode(' and ', $bookingTypes);

        return redirect()->route('thank.you')->with('success', ucfirst($bookingTypeText) . ' booking submitted successfully!')
            ->with('adults', $request->adults)
            ->with('children', $request->children);
    }

    public function showRoomForm()
    {
        $rooms = [
            'kubo-hut' => 'Native Kubo Hut',
            'cottage' => 'Mountain Cottage',
            'cabin' => 'Forest Cabin',
            'suite' => 'Premium Suite'
        ];

        return view('book-room', compact('rooms'));
    }

    public function submitRoomBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'booking_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'nullable|date|after:booking_date',
            'room_type' => 'required|string',
            'adults' => 'required|integer|min:1|max:20',
            'children' => 'required|integer|min:0|max:20',
            'notes' => 'nullable|string',
            'receipt' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120' // 5MB max
        ]);

        $roomPrice = $this->roomPrices[$request->room_type] ?? 0;
        $entranceFee = ($request->adults * $this->entranceFeeAdult) + ($request->children * $this->entranceFeeChild);

        // Calculate number of nights
        $checkin = new \DateTime($request->booking_date);
        $checkout = $request->checkout_date ? new \DateTime($request->checkout_date) : null;
        $nights = 1;
        if ($checkout && $checkout > $checkin) {
            $interval = $checkin->diff($checkout);
            $nights = $interval->days;
        }

        $totalAmount = ($roomPrice * $nights) + $entranceFee;

        // Handle file upload
        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receipt = $request->file('receipt');
            $receiptPath = $receipt->store('receipts', 'public');
        }

        // Create the booking directly without using session
        $booking = Booking::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'type' => 'room',
            'booking_date' => $validated['booking_date'],
            'checkout_date' => $validated['checkout_date'] ?? null,
            'selection' => $validated['room_type'],
            'adults' => $validated['adults'],
            'children' => $validated['children'],
            'notes' => $validated['notes'] ?? null,
            'total_amount' => $totalAmount,
            'payment_method' => 'gcash',
            'receipt_path' => $receiptPath,
            'payment_status' => 'pending'
        ]);

        return redirect()->route('thank.you')
            ->with('success', 'Room booking submitted successfully!')
            ->with('adults', $validated['adults'])
            ->with('children', $validated['children']);
    }

    public function reviewRoomBooking(Request $request)
    {
        $data = $request->session()->get('room_booking');
        if (!$data) {
            return redirect()->route('book.room');
        }
        return view('book-room-review', ['data' => $data]);
    }

    public function confirmRoomBooking(Request $request)
    {
        $data = $request->session()->get('room_booking');
        if (!$data) {
            return redirect()->route('book.room');
        }

        // Handle file upload
        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receipt = $request->file('receipt');
            $receiptPath = $receipt->store('receipts', 'public');
        }

        $roomNotes = $data['notes'] ?? '';
        if (!empty($data['checkout_date'])) {
            $roomNotes .= ($roomNotes ? "\n" : "") . "Check-out date: " . $data['checkout_date'];
        }

        // Create the booking with payment information
        $booking = Booking::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'type' => 'room',
            'booking_date' => $data['booking_date'],
            'checkout_date' => $data['checkout_date'] ?? null,
            'selection' => $data['room_type'],
            'adults' => $data['adults'],
            'children' => $data['children'],
            'notes' => $roomNotes,
            'total_amount' => $data['total_amount'] ?? 0,
            'payment_method' => 'gcash',
            'receipt_path' => $receiptPath,
            'payment_status' => 'pending'
        ]);

        $request->session()->forget('room_booking');

        return redirect()->route('thank.you')->with('success', 'Room booking submitted successfully!')
            ->with('adults', $data['adults'])
            ->with('children', $data['children']);
    }

    public function showActivityForm()
    {
        $activities = [
            'paintball' => 'Paintball Battles',
            'rappelling' => 'Rappelling',
            'hiking' => 'Guided Hikes',
            'farm-tour' => 'Organic Farm Tours'
        ];

        return view('book-activity', compact('activities'));
    }

    public function submitActivityBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'booking_date' => 'required|date|after:today',
            'activity' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $totalAmount = ($request->adults ?? 0) * 100 + ($request->children ?? 0) * 50;

        // Store input and total amount in session for review
        $data = $request->all();
        $data['total_amount'] = $totalAmount;
        $request->session()->put('activity_booking', $data);

        return redirect()->route('book.activity.review');
    }

    public function reviewActivityBooking(Request $request)
    {
        $data = $request->session()->get('activity_booking');
        if (!$data) {
            return redirect()->route('book.activity');
        }
        return view('book-activity-review', ['data' => $data]);
    }

    public function confirmActivityBooking(Request $request)
    {
        $data = $request->session()->get('activity_booking');
        if (!$data) {
            return redirect()->route('book.activity');
        }

        Booking::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 'activity',
            'booking_date' => $data['booking_date'],
            'selection' => $data['activity'],
            'notes' => $data['notes'] ?? '',
            'total_amount' => $data['total_amount'] ?? 0
        ]);

        $request->session()->forget('activity_booking');

        return redirect()->route('thank.you')->with('success', 'Activity booking submitted successfully!');
    }

    public function thankYou()
    {
        $data = [
            'name' => session('name', old('name', 'Your Name')),
            'email' => session('email', old('email', 'Your Email')),
            'adults' => session('adults', old('adults', 1)),
            'children' => session('children', old('children', 0)),
            'room_type' => session('room_type', old('room_type', 'N/A')),
            'room_date' => session('room_date', old('room_date', 'N/A')),
            'room_checkout' => session('room_checkout', old('room_checkout', 'N/A')),
            'activity' => session('activity', old('activity', 'N/A')),
            'activity_date' => session('activity_date', old('activity_date', 'N/A')),
            'notes' => session('notes', old('notes', 'None')),
            'total_amount' => session('total_amount', old('total_amount', 0)),
        ];
        return view('thank-you', $data);
    }

    public function downloadReceipt()
    {
        $data = [
            'name' => session('name', old('name', 'Your Name')),
            'email' => session('email', old('email', 'Your Email')),
            'adults' => session('adults', old('adults', 1)),
            'children' => session('children', old('children', 0)),
            'room_type' => session('room_type', old('room_type', 'N/A')),
            'room_date' => session('room_date', old('room_date', 'N/A')),
            'room_checkout' => session('room_checkout', old('room_checkout', 'N/A')),
            'activity' => session('activity', old('activity', 'N/A')),
            'activity_date' => session('activity_date', old('activity_date', 'N/A')),
            'notes' => session('notes', old('notes', 'None')),
        ];
        $pdf = Pdf::loadView('receipt-pdf', $data);
        return $pdf->download('booking-receipt.pdf');
    }
}
