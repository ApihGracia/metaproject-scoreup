{{-- <div class="max-w-md mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">Technician Registration</h2>

    <form wire:submit.prevent="register" class="space-y-4">
        <div>
            <label>Name</label>
            <input type="text" wire:model.defer="name" class="w-full border p-2" required />
        </div>

        <div>
            <label>Email</label>
            <input type="email" wire:model.defer="email" class="w-full border p-2" required />
        </div>

        <div>
            <label>Sport</label>
            <select wire:model.defer="sport_id" class="w-full border p-2">
                <option value="">-- Choose Sport --</option>
                <option value="1">Futsal</option>
                <option value="2">Badminton</option>
                <option value="3">Netball</option>
                <option value="4">Volleyball</option>
            </select>
        </div>

        <div>
            <label>Phone Number</label>
            <input type="text" wire:model.defer="phone_number" class="w-full border p-2" required />
        </div>

        <div>
            <label>Password</label>
            <input type="password" wire:model.defer="password" class="w-full border p-2" required />
        </div>

        <div>
            <label>Confirm Password</label>
            <input type="password" wire:model.defer="password_confirmation" class="w-full border p-2" required />
        </div>

        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded">Register</button>
    </form>
</div> --}}



<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create a Sport Technician account')" :description="__('Enter your details below to create your Sport Technician account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input wire:model.defer="name" :label="__('Name')" type="text" required autofocus autocomplete="name" :placeholder="__('Full name')" />

        <!-- Email Address -->
        <flux:input wire:model.defer="email" :label="__('Email address')" type="email" required autocomplete="email" placeholder="email@example.com" />

        <!-- Sport Type -->
        <div>
            <label>Sport Type</label>
            <flux:select wire:model.defer="sport_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Choose Sport --</option>
                <option value="1">Futsal</option>
                <option value="2">Badminton</option>
                <option value="3">Netball</option>
                <option value="4">Volleyball</option>
            </flux:select>
        </div>

        <!-- Name -->
        <flux:input wire:model.defer="phone_number" :label="__('Phone Number')" type="text" required autofocus autocomplete="phone-number" :placeholder="__('Phone Number')" />

        <!-- Password -->
        <flux:input wire:model.defer="password" :label="__('Password')" type="password" required autocomplete="new-password" :placeholder="__('Password')" viewable />

        <!-- Confirm Password -->
        <flux:input wire:model.defer="password_confirmation" :label="__('Confirm password')" type="password" required autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

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
