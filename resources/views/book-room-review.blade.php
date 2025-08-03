@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-magdiwata-900 mb-6">Review Your Room Booking</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Room Type:</strong> {{ $data['room_type'] }}</p>
        <p><strong>Check-in Date:</strong> {{ $data['booking_date'] }}</p>
        <p><strong>Check-out Date:</strong> {{ $data['checkout_date'] ?? 'Not specified' }}</p>
        <p><strong>Adults:</strong> {{ $data['adults'] }}</p>
        <p><strong>Children:</strong> {{ $data['children'] }}</p>
        <p><strong>Notes:</strong> {{ $data['notes'] ?? 'None' }}</p>
        <p class="mt-4 font-semibold">Entrance fee: Child is ₱50, Adult is ₱100</p>
        <p class="mt-2 font-bold text-lg">Total Amount: ₱{{ $data['total_amount'] ?? ($data['adults'] * 100 + $data['children'] * 50) }}</p>
    </div>

    <form method="POST" action="{{ route('book.room.confirm') }}">
        @csrf
        <div class="flex space-x-4">
            <a href="{{ route('book.room') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Edit</a>
            <button type="submit" class="px-4 py-2 bg-magdiwata-900 text-white rounded hover:bg-magdiwata-800">Confirm Booking</button>
        </div>
    </form>
</div>
@endsection
