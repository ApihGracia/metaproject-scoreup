<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input wire:model="email" :label="__('Email address')" type="email" required autocomplete="email" placeholder="email@example.com" />

        <!-- Password -->
        <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="new-password" :placeholder="__('Password')" viewable />

        <!-- Confirm Password -->
        <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password" required autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

        <!-- Role Selection -->
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-1">Role</label>
            <select wire:model="role" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="public">Public User</option>
                <option value="technician">Sport Technician</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Sport Selection (if technician) -->
        @if ($role === 'technician')
            <div>
                <label class="block font-medium text-sm text-gray-700 mb-1">Sport</label>
                <select wire:model="sport" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Choose Sport --</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Netball">Netball</option>
                    <option value="Volleyball">Volleyball</option>
                </select>
            </div>
        @endif

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
