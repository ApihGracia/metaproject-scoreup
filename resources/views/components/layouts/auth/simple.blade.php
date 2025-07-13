<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            body {
                background-color: #F9FAFB;
                color: #1F2937;
            }
            .primary {
                color: #DC2626;
            }
            .accent {
                color: #F97316;
            }
        </style>
    </head>
    <body class="min-h-screen antialiased" style="background-color:#F9FAFB; color:#1F2937;">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10" style="background-color:#F9FAFB;">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-[96px] w-auto mb-1 items-center justify-center rounded-md">
                        <x-app-logo-icon class="h-[96px] w-auto" />
                    </span>
                    <span class="sr-only primary">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    <x-flux-card class="p-6 shadow-lg border-2 border-[#DC2626] bg-white text-[#1F2937]" style="border-color:#E5E7EB;">
                        {{ $slot }}
                    </x-flux-card>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>