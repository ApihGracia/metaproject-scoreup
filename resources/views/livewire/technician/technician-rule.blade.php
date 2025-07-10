<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Sport Rules (PDF)</h1>

    @if(session()->has('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    <h2 class="text-xl font-semibold mb-2">All Rules</h2>
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Sport</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">PDF</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rules as $rule)
                <tr>
                    <td class="border px-4 py-2">{{ $rule->sport->sport_name ?? $rule->sport->name }}</td>
                    <td class="border px-4 py-2">{{ $rule->title }}</td>
                    <td class="border px-4 py-2">{{ $rule->description }}</td>
                    <td class="border px-4 py-2">
                        {{-- @if($rule->file_path)
                            <button wire:click="viewPdf({{ $rule->RuleID }})" class="bg-green-600 text-white px-2 py-1 rounded">View</button>
                        @else
                            <span class="text-gray-400">No PDF</span>
                        @endif --}}
                         @if($rule->file_path)
                            <a href="{{ asset('storage/'.$rule->file_path) }}" target="_blank" class="text-blue-600 underline">
                                View PDF
                            </a>
                        @else
                            <span class="text-gray-400">No PDF</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No rules found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PDF Modal --}}
    @if($showPdfModal && $pdfUrl)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded shadow-lg p-4 max-w-3xl w-full relative">
                <button wire:click="closePdfModal" class="absolute top-2 right-2 text-gray-600 hover:text-black">&times;</button>
                <iframe src="{{ $pdfUrl }}" class="w-full h-96" frameborder="0"></iframe>
                <div class="mt-2 text-right">
                    <a href="{{ $pdfUrl }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="window.print();return false;">Print</a>
                </div>
            </div>
        </div>
    @endif
</div>
