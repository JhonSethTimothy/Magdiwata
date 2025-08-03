<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-magdiwata-900">Admin Dashboard</h1>
                    <p class="text-gray-600 mt-2">Manage bookings and monitor resort activities</p>
                </div>
                <div>
                    <a href="{{ route('book.room') }}" class="inline-flex items-center px-4 py-2 bg-magdiwata-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-magdiwata-700 focus:bg-magdiwata-700 active:bg-magdiwata-800 focus:outline-none focus:ring-2 focus:ring-magdiwata-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Booking
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-magdiwata-100">
                            <svg class="w-6 h-6 text-magdiwata-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Bookings</p>
                            <p class="text-2xl font-semibold text-magdiwata-900">{{ $totalBookings }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Room Bookings</p>
                            <p class="text-2xl font-semibold text-blue-600">{{ $roomBookings }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Activity Bookings</p>
                            <p class="text-2xl font-semibold text-green-600">{{ $activityBookings }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Cancelled</p>
                            <p class="text-2xl font-semibold text-red-600">{{ $cancelledBookings ?? '0' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Rescheduled</p>
                            <p class="text-2xl font-semibold text-yellow-600">{{ $rescheduledBookings ?? '0' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter and Sort Form -->
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-lg font-semibold text-magdiwata-900">All Bookings</h2>
                <form method="GET" class="flex flex-wrap gap-2 items-end">
                    <div>
                        <label for="type" class="block text-xs font-medium text-gray-600">Type</label>
                        <select name="type" id="type" class="border-gray-300 rounded-md text-sm">
                            <option value="">All</option>
                            <option value="room" @if(request('type')=='room') selected @endif>Room</option>
                            <option value="activity" @if(request('type')=='activity') selected @endif>Activity</option>
                        </select>
                    </div>
                    <div>
                        <label for="date_from" class="block text-xs font-medium text-gray-600">From</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <label for="date_to" class="block text-xs font-medium text-gray-600">To</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="border-gray-300 rounded-md text-sm">
                    </div>
                    <button type="submit" class="bg-magdiwata-900 hover:bg-magdiwata-800 text-white px-3 py-2 rounded-md text-xs font-semibold">Filter</button>
                    @if(request()->hasAny(['type','date_from','date_to']))
                        <a href="{{ route('dashboard') }}" class="text-xs text-magdiwata-700 underline ml-2">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Recent Bookings Table -->
            <div class="bg-white rounded-lg shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'email','direction'=>$sort=='email'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Email
                                        @if($sort=='email')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'type','direction'=>$sort=='type'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Type
                                        @if($sort=='type')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'selection','direction'=>$sort=='selection'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Selection
                                        @if($sort=='selection')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'booking_date','direction'=>$sort=='booking_date'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Check-in Date
                                        @if($sort=='booking_date')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    Check-in Time
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                                    <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'checkout_date','direction'=>$sort=='checkout_date'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Check-out Date & Time
                                        @if($sort=='checkout_date')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                                    </a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Adults</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Children</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Notes</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $i => $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $booking->type === 'room' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($booking->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->selection }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->booking_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @php
                                            $checkoutDate = null;
                                            $checkoutTime = null;
                                            
                                            if ($booking->checkout_date) {
                                                $checkoutDate = $booking->checkout_date->format('M d, Y');
                                                // Try to get checkout time if available
                                                if (preg_match('/Check-out time: (\d{1,2}:\d{2} [AP]M)/i', $booking->notes ?? '', $matches)) {
                                                    $checkoutTime = $matches[1];
                                                }
                                            } else {
                                                // Try to extract check-out date from notes
                                                if (preg_match('/Check-out date: (\d{4}-\d{2}-\d{2})/i', $booking->notes ?? '', $matches)) {
                                                    $checkoutDate = \Carbon\Carbon::parse($matches[1])->format('M d, Y');
                                                    // Remove the check-out date from notes
                                                    $booking->notes = trim(preg_replace('/Check-out date: \d{4}-\d{2}-\d{2}\s*/i', '', $booking->notes));
                                                    
                                                    // Try to get checkout time if available
                                                    if (preg_match('/Check-out time: (\d{1,2}:\d{2} [AP]M)/i', $booking->notes ?? '', $timeMatches)) {
                                                        $checkoutTime = $timeMatches[1];
                                                        // Remove the time from notes
                                                        $booking->notes = trim(preg_replace('/Check-out time: \d{1,2}:\d{2} [AP]M\s*/i', '', $booking->notes));
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if($checkoutDate)
                                            <div>{{ $checkoutDate }}</div>
                                            @if($checkoutTime)
                                                <div class="text-xs text-gray-500">{{ $checkoutTime }}</div>
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->check_in_time ? date('h:i A', strtotime($booking->check_in_time)) : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->check_out_time ? date('h:i A', strtotime($booking->check_out_time)) : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->adults }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->children }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                        @php
                                            // If we extracted check-out date from notes, $booking->notes is already updated
                                            // Just need to clean up any empty notes
                                            $notes = trim($booking->notes ?? '');
                                        @endphp
                                        @if($notes)
                                            <div class="truncate" title="{{ $notes }}">
                                                {{ Str::limit($notes, 50) }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">No notes</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                            $colorClass = $statusColors[strtolower($booking->status)] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <button
                                            class="text-magdiwata-700 hover:text-magdiwata-900 focus:outline-none"
                                            onclick="openModal({{ json_encode($booking) }})"
                                            aria-label="View Details"
                                        >
                                            View
                                        </button>
                                        
                                        @if(!in_array(strtolower($booking->status), ['cancelled', 'completed']))
                                            <form method="POST" action="{{ route('dashboard.booking.update-status', $booking) }}" class="inline" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold text-sm" aria-label="Cancel Booking">
                                                    Cancel
                                                </button>
                                            </form>
                                            
                                            <button 
                                                onclick="openRescheduleModal({{ json_encode($booking) }})"
                                                class="text-blue-600 hover:text-blue-900 font-semibold text-sm"
                                                aria-label="Reschedule Booking"
                                            >
                                                Reschedule
                                            </button>

                                            <button 
                                                onclick="openTimeUpdateModal({{ json_encode($booking) }})"
                                                class="text-purple-600 hover:text-purple-900 font-semibold text-sm"
                                                aria-label="Update Times"
                                            >
                                                Set Times
                                            </button>
                                        @endif
                                        
                                        @if($booking->status === 'pending')
                                            <form method="POST" action="{{ route('dashboard.booking.update-status', $booking) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="text-green-600 hover:text-green-900 font-semibold text-sm" aria-label="Confirm Booking">
                                                    Confirm
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($booking->status === 'confirmed' && $booking->status !== 'completed')
                                            <form method="POST" action="{{ route('dashboard.booking.complete', $booking) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 font-semibold text-sm" aria-label="Mark as Completed">
                                                    Complete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                                        No bookings found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4">{{ $bookings->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 focus:outline-none" aria-label="Close modal">&times;</button>
            <h3 class="text-xl font-semibold mb-4">Booking Details</h3>
            <div id="modalContent" class="space-y-2 text-gray-800">
                <!-- Booking details will be populated here -->
            </div>
        </div>
    </div>

    <script>
        function openModal(booking) {
            const modal = document.getElementById('bookingModal');
            const modalContent = document.getElementById('modalContent');
            // Format times if they exist
            const formatTime = (timeStr) => {
                if (!timeStr) return 'Not set';
                const time = new Date('1970-01-01T' + timeStr + 'Z');
                return time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            };

            modalContent.innerHTML = `
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold text-gray-700">Guest Name:</p>
                            <p>${booking.name}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Email:</p>
                            <p>${booking.email}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold text-gray-700">Type:</p>
                            <p>${booking.type}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Selection:</p>
                            <p>${booking.selection}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold text-gray-700">Check-in:</p>
                            <p>
                                ${new Date(booking.booking_date).toLocaleDateString()}
                                ${booking.check_in_time ? 'at ' + formatTime(booking.check_in_time) : ''}
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Check-out:</p>
                            <p>
                                ${booking.check_out_date ? new Date(booking.check_out_date).toLocaleDateString() : 'N/A'}
                                ${booking.check_out_time ? 'at ' + formatTime(booking.check_out_time) : ''}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="font-semibold text-gray-700">Adults:</p>
                            <p>${booking.adults}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700">Children:</p>
                            <p>${booking.children}</p>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Notes:</p>
                        <p class="mt-1 p-2 bg-gray-50 rounded">${booking.notes || 'No notes provided'}</p>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-700">Status:</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                            booking.status === 'completed' ? 'bg-green-100 text-green-800' :
                            booking.status === 'cancelled' ? 'bg-red-100 text-red-800' :
                            booking.status === 'rescheduled' ? 'bg-blue-100 text-blue-800' :
                            'bg-yellow-100 text-yellow-800'
                        }">
                            ${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}
                        </span>
                    </div>
                </div>
            `;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('bookingModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Time Update Modal Functions
        let currentBookingForTimeUpdate = null;

        function openTimeUpdateModal(booking) {
            currentBookingForTimeUpdate = booking;
            const modal = document.getElementById('timeUpdateModal');
            const form = document.getElementById('timeUpdateForm');
            
            // Set the booking ID in the form
            form.action = `/dashboard/booking/${booking.id}/times`;
            
            // Set current times if they exist
            if (booking.check_in_time) {
                document.getElementById('update_check_in_time').value = booking.check_in_time;
            }
            if (booking.check_out_time) {
                document.getElementById('update_check_out_time').value = booking.check_out_time;
            }
            
            // Show the modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeTimeUpdateModal() {
            const modal = document.getElementById('timeUpdateModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Handle time update form submission
        document.getElementById('timeUpdateForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            try {
                submitButton.disabled = true;
                submitButton.innerHTML = 'Updating...';
                
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        check_in_time: formData.get('check_in_time'),
                        check_out_time: formData.get('check_out_time'),
                        _method: 'PATCH'
                    })
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    // Show success message
                    alert('Booking times updated successfully!');
                    // Reload the page to show updated data
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Failed to update booking times');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        });

        // Reschedule Modal Functions
        function openRescheduleModal(booking) {
            const modal = document.getElementById('rescheduleModal');
            const form = document.getElementById('rescheduleForm');
            
            // Set the booking ID in the form
            form.action = `/dashboard/booking/${booking.id}/reschedule`;
            
            // Format dates for the date inputs
            const formatDateForInput = (dateString) => {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toISOString().split('T')[0];
            };
            
            // Format time for the time inputs (HH:MM)
            const formatTimeForInput = (timeString) => {
                if (!timeString) return '14:00'; // Default check-in time
                const time = new Date(`2000-01-01T${timeString}`);
                return time.toTimeString().slice(0, 5);
            };
            
            // Set form values
            document.getElementById('new_booking_date').value = formatDateForInput(booking.booking_date);
            document.getElementById('new_check_out_date').value = formatDateForInput(booking.check_out_date);
            document.getElementById('check_in_time').value = formatTimeForInput(booking.check_in_time);
            document.getElementById('check_out_time').value = formatTimeForInput(booking.check_out_time);
            
            // Set minimum date to today for date inputs
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('new_booking_date').min = today;
            document.getElementById('new_check_out_date').min = today;
            
            // Show the modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Add event listener to validate check-out date is after check-in date
            document.getElementById('new_booking_date').addEventListener('change', function() {
                const checkInDate = this.value;
                const checkOutDateInput = document.getElementById('new_check_out_date');
                checkOutDateInput.min = checkInDate;
                if (checkOutDateInput.value && checkOutDateInput.value < checkInDate) {
                    checkOutDateInput.value = checkInDate;
                }
            });
        }

        function closeRescheduleModal() {
            const modal = document.getElementById('rescheduleModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modals when clicking outside the content
        window.onclick = function(event) {
            const bookingModal = document.getElementById('bookingModal');
            const rescheduleModal = document.getElementById('rescheduleModal');
            
            if (event.target === bookingModal) {
                closeModal();
            }
            
            if (event.target === rescheduleModal) {
                closeRescheduleModal();
            }
        };

        // Handle form submission with fetch for better UX
        document.getElementById('rescheduleForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            
            try {
                // Show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = 'Updating...';
                
                const formData = new FormData(form);
                const requestData = {
                    booking_date: formData.get('booking_date'),
                    check_out_date: formData.get('check_out_date'),
                    check_in_time: formData.get('check_in_time'),
                    check_out_time: formData.get('check_out_time'),
                    _method: 'PATCH'
                };

                // Validate check-out date is after check-in date
                const checkInDate = new Date(`${requestData.booking_date}T${requestData.check_in_time}`);
                const checkOutDate = new Date(`${requestData.check_out_date}T${requestData.check_out_time}`);
                
                if (checkOutDate <= checkInDate) {
                    throw new Error('Check-out date and time must be after check-in date and time');
                }

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(requestData)
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    // Show success message
                    alert('Booking rescheduled successfully!');
                    // Reload the page to show updated data
                    window.location.reload();
                } else {
                    throw new Error(result.message || 'Failed to reschedule booking');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        });
    </script>

    <!-- Time Update Modal -->
    <div id="timeUpdateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <button onclick="closeTimeUpdateModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 focus:outline-none" aria-label="Close modal">×</button>
            <h3 class="text-xl font-semibold mb-4">Update Booking Times</h3>
            <form id="timeUpdateForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div class="space-y-2">
                    <div>
                        <label for="update_check_in_time" class="block text-sm font-medium text-gray-700">Check-in Time</label>
                        <input type="time" id="update_check_in_time" name="check_in_time" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="update_check_out_time" class="block text-sm font-medium text-gray-700">Check-out Time</label>
                        <input type="time" id="update_check_out_time" name="check_out_time" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeTimeUpdateModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-magdiwata-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-magdiwata-900 border border-transparent rounded-md hover:bg-magdiwata-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-magdiwata-500">
                        Update Times
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
            <button onclick="closeRescheduleModal()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 focus:outline-none" aria-label="Close modal">&times;</button>
            <h3 class="text-xl font-semibold mb-4">Reschedule Booking</h3>
            <form id="rescheduleForm" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <!-- Check-in Date & Time -->
                <div class="space-y-2">
                    <h4 class="text-sm font-medium text-gray-700">Check-in</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="new_booking_date" class="block text-xs text-gray-500">Date</label>
                            <input type="date" id="new_booking_date" name="booking_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="check_in_time" class="block text-xs text-gray-500">Time</label>
                            <input type="time" id="check_in_time" name="check_in_time" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <!-- Check-out Date & Time -->
                <div class="space-y-2">
                    <h4 class="text-sm font-medium text-gray-700">Check-out</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="new_check_out_date" class="block text-xs text-gray-500">Date</label>
                            <input type="date" id="new_check_out_date" name="check_out_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="check_out_time" class="block text-xs text-gray-500">Time</label>
                            <input type="time" id="check_out_time" name="check_out_time" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-magdiwata-500 focus:ring focus:ring-magdiwata-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-gray-200">
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRescheduleModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-magdiwata-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-magdiwata-900 border border-transparent rounded-md hover:bg-magdiwata-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-magdiwata-500">
                            Update Booking
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
