{{-- <x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app> --}}

<!-- resources/views/livewire/admin/dashboard.blade.php -->
<x-layouts.app :title="__('Dashboard')">
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Admin Dashboard - Scoreboard Management</h1>

    <div class="mb-6">
        <label class="block font-semibold mb-2">Add New Team</label>
        <input type="text" wire:model.defer="newTeamName" class="border p-2 rounded mr-2">
        <button wire:click="addNewTeam" class="bg-green-500 text-white px-4 py-2 rounded">Add Team</button>
    </div>

    {{-- <div class="mb-6">
        <label class="block font-semibold mb-2">Select Team</label>
        <select wire:model="selectedTeamId" class="border p-2 rounded w-full">
            <option value="">-- Choose Team --</option>
            @foreach($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div> --}}

    {{-- @if($selectedTeamId) --}}
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label>Gold</label>
                <input type="number" wire:model="gold" class="border p-2 rounded w-full">
            </div>
            <div>
                <label>Silver</label>
                <input type="number" wire:model="silver" class="border p-2 rounded w-full">
            </div>
            <div>
                <label>Bronze</label>
                <input type="number" wire:model="bronze" class="border p-2 rounded w-full">
            </div>
        </div>
        <button wire:click="updateMedals" class="bg-blue-600 text-white px-4 py-2 rounded">Update Medals</button>
    {{-- @endif --}}

    <hr class="my-8">

    <h2 class="text-lg font-semibold mb-2">Scoreboard</h2>
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Team</th>
                <th class="border px-4 py-2">Gold</th>
                <th class="border px-4 py-2">Silver</th>
                <th class="border px-4 py-2">Bronze</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        {{-- <tbody>
            @foreach($scoreboards as $score)
                <tr>
                    <td class="border px-4 py-2">{{ $score->team->name }}</td>
                    <td class="border px-4 py-2">{{ $score->gold }}</td>
                    <td class="border px-4 py-2">{{ $score->silver }}</td>
                    <td class="border px-4 py-2">{{ $score->bronze }}</td>
                    <td class="border px-4 py-2">{{ $score->gold + $score->silver + $score->bronze }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="deleteTeam({{ $score->team_id }})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>
</x-layouts.app>
