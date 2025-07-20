{{-- filepath: resources/views/livewire/technician/technician-scoreboard.blade.php --}}
<div class="p-20 max-w-6xl mx-auto" wire:poll.5s>
    <h1 class="text-2xl font-bold mb-4">Live Scoreboard</h1>
    <h2 class="text-xl font-bold mb-2">Overview of Total Medals per Team</h2>
    <div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse rounded-2xl overflow-hidden shadow-lg border border-gray-300 mt-6">
        <thead>
            <tr class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 text-black text-lg">
                <th class="px-4 py-2 rounded-l-2xl font-extrabold border">Team</th>
                <th class="px-4 py-2 font-extrabold border">🥇 Gold</th>
                <th class="px-4 py-2 font-extrabold border">🥈 Silver</th>
                <th class="px-4 py-2 font-extrabold border">🥉 Bronze</th>
                <th class="px-4 py-2 font-extrabold border">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overview as $row)
                <tr class="text-gray-900 text-center font-bold shadow-lg rounded-2xl hover:bg-orange-50 transition border px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100">
                    <td class="px-4 py-2 rounded-l-2xl flex items-center gap-2 justify-left">
                        @if($row['team']->photo)
                            <img src="{{ asset('storage/' . $row['team']->photo) }}" alt="logo" class="w-8 h-8 rounded-full object-cover border border-gray-300 shadow" />
                        @else
                            <span class="inline-block w-8 h-8 rounded-full bg-gray-200 border-gray-300"></span>
                        @endif
                        <span>{{ $row['team']->name }}</span>
                    </td>
                    <td class="px-4 py-2 text-yellow-500 font-extrabold border">{{ $row['gold'] }}</td>
                    <td class="px-4 py-2 text-gray-700 font-extrabold border">{{ $row['silver'] }}</td>
                    <td class="px-4 py-2 text-orange-500 font-extrabold border">{{ $row['bronze'] }}</td>
                    <td class="px-4 py-2 text-black font-extrabold border">{{ $row['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
