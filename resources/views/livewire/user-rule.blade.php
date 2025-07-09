<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Sport Rules</h1>

    @if (session()->has('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    <div class="space-y-4">
        @forelse($rules as $rule)
            <div class="bg-white rounded-xl shadow p-4 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="font-semibold text-lg">{{ $rule->title }}</div>
                    <div class="text-sm text-gray-500 mb-1">Sport: {{ $rule->sport->sport_name ?? '-' }}</div>
                    <div class="text-gray-700">{{ $rule->description }}</div>
                </div>
                <div class="mt-2 md:mt-0">
                    @if($rule->file_path)
                        <button wire:click="viewPdf({{ $rule->id }})" class="bg-blue-600 text-white px-4 py-2 rounded">
                            View PDF
                        </button>
                    @else
                        <span class="text-gray-400">No PDF</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">No rules found.</div>
        @endforelse
    </div>

    {{-- PDF Modal --}}
    @if($showPdfModal && $pdfUrl)
        <div class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-4 max-w-2xl w-full relative">
                <button wire:click="closePdfModal" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">&times;</button>
                <iframe src="{{ $pdfUrl }}" class="w-full h-[70vh] rounded" frameborder="0"></iframe>
            </div>
        </div>
    @endif
</div>