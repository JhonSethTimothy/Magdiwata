<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">#</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">
                <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'name','direction'=>$sort=='name'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Guest Name
                    @if($sort=='name')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                </a>
            </th>
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
                <a href="?{{ http_build_query(array_merge(request()->except('sort','direction','page'), ['sort'=>'booking_date','direction'=>$sort=='booking_date'&&$direction=='asc'?'desc':'asc'])) }}" class="hover:underline">Booking Date
                    @if($sort=='booking_date')<span>{{ $direction=='asc'?'▲':'▼' }}</span>@endif
                </a>
            </th>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Check-in Date</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Check-in Time</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Check-out Date</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-magdiwata-900 uppercase tracking-wider">Check-out Time</th>
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
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($bookings->currentPage()-1)*$bookings->perPage() + $i + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->name }}</td>
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
                    {{ $booking->check_in_date ? $booking->check_in_date->format('M d, Y') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $booking->check_in_time ? $booking->check_in_time->format('H:i') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $booking->check_out_date ? $booking->check_out_date->format('M d, Y') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $booking->check_out_time ? $booking->check_out_time->format('H:i') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $booking->adults }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $booking->children }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                    @if($booking->notes)
                        <div class="truncate" title="{{ $booking->notes }}">
                            {{ Str::limit($booking->notes, 50) }}
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
                            'completed' => 'bg-gray-100 text-gray-800',
                        ];
                        $colorClass = $statusColors[strtolower($booking->status)] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                        class="text-magdiwata-700 hover:text-magdiwata-900 focus:outline-none"
                        onclick="openModal({{ json_encode($booking) }})"
                        aria-label="View Details"
                    >
                        View Details
                    </button>
                    @if($booking->status !== 'completed')
                        <form method="POST" action="{{ route('dashboard.booking.complete', $booking) }}" class="inline">
                            @csrf
                            <button type="submit" class="ml-2 text-green-600 hover:text-green-900 font-semibold text-sm" aria-label="Mark as Completed">
                                Mark Completed
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="14" class="px-6 py-4 text-center text-gray-500">
                    No bookings found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
