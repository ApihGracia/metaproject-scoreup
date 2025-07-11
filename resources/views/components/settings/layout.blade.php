<div class="min-h-screen bg-[#F9FAFB] py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-[#1F2937]">ㅤㅤㅤ</h1>
            <div class="flex items-center gap-3">
                <input type="text" placeholder="Search settings..." class="rounded-full border border-[#E5E7EB] bg-white px-4 py-2 text-sm focus:border-[#DC2626] focus:ring-2 focus:ring-[#F97316] outline-none" />
                <button class="bg-[#F97316] text-white font-semibold px-5 py-2 rounded-full shadow hover:bg-[#DC2626] transition">Go Pro</button>
            </div>
        </div>
        <x-flux-card class="bg-white rounded-2xl shadow p-8">
            <div class="flex border-b border-[#E5E7EB] mb-8 gap-12">
                <a href="{{ route('settings.profile') }}" class="pb-3 text-base font-medium text-[#1F2937] border-b-2 {{ request()->routeIs('settings.profile') ? 'border-[#DC2626]' : 'border-transparent' }} hover:text-[#DC2626] hover:border-[#F97316] transition">Profile</a>
                <a href="{{ route('settings.password') }}" class="pb-3 text-base font-medium text-[#1F2937] border-b-2 {{ request()->routeIs('settings.password') ? 'border-[#DC2626]' : 'border-transparent' }} hover:text-[#DC2626] hover:border-[#F97316] transition">Password</a>
                <a href="{{ route('settings.appearance') }}" class="pb-3 text-base font-medium text-[#1F2937] border-b-2 {{ request()->routeIs('settings.appearance') ? 'border-[#DC2626]' : 'border-transparent' }} hover:text-[#DC2626] hover:border-[#F97316] transition">Appearance</a>
            </div>
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#1F2937]">{{ $heading ?? '' }}</h2>
                <p class="text-sm text-[#6B7280]">{{ $subheading ?? '' }}</p>
            </div>
            <div class="mt-5 w-full max-w-2xl">
                {{ $slot }}
            </div>
        </x-flux-card>
    </div>
</div>