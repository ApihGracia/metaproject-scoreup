{{-- filepath: resources/views/livewire/admin/admin-team.blade.php --}}
<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Teams</h1>

    {{-- <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div>
            <label class="block font-semibold mb-1">Team Name</label>
            <input type="text" wire:model.defer="name" class="border p-2 rounded w-full">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea wire:model.defer="description" class="border p-2 rounded w-full"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $editId ? 'Update Team' : 'Add Team' }}
            </button>
            @if($editId)
                <button type="button" wire:click="cancelEdit" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            @endif
        </div>
    </form> --}}

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div>
            <label class="block font-semibold mb-1">Team Name</label>
            <input type="text" wire:model.defer="name" class="border p-2 rounded w-full">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea wire:model.defer="description" class="border p-2 rounded w-full"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Team Photo (optional)</label>
            <input type="file" wire:model="photo" class="border p-2 rounded w-full" accept="image/*">
            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @if($photo)
                <img src="{{ $photo->temporaryUrl() }}" class="h-16 mt-2">
            @endif
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $editId ? 'Update Team' : 'Add Team' }}
            </button>
            @if($editId)
                <button type="button" wire:click="cancelEdit" class="bg-gray-400 text-white px-4 py-2 rounded">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <h2 class="text-xl font-semibold mb-2">Existing Teams</h2>
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Team Name</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teams as $team)
                <tr>
                    <td class="border px-4 py-2">
                        @if($team->photo)
                            <img src="{{ asset('storage/'.$team->photo) }}" class="h-10">
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $team->name }}</td>
                    <td class="border px-4 py-2">{{ $team->description }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $team->id }})" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $team->id }})" class="bg-red-500 text-white px-2 py-1 rounded ml-2"
                            onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No teams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
