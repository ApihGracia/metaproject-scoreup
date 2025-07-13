<!-- resources/views/livewire/technician/dashboard.blade.php -->
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Live Scoreboard</h1>

    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Team</th>
                <th class="border px-4 py-2">Gold</th>
                <th class="border px-4 py-2">Silver</th>
                <th class="border px-4 py-2">Bronze</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scoreboards as $score)
                <tr class="text-center hover:bg-gray-50 cursor-pointer" wire:click="viewTeam('{{ $score->team->id }}')">
                    <td class="border px-4 py-2">{{ $score->team->name }}</td>
                    <td class="border px-4 py-2">{{ $score->gold }}</td>
                    <td class="border px-4 py-2">{{ $score->silver }}</td>
                    <td class="border px-4 py-2">{{ $score->bronze }}</td>
                    <td class="border px-4 py-2 font-semibold">{{ $score->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Placeholder: Modal or redirect to sport list for selected team -->
</div>
