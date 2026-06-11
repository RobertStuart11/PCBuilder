<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-1">Reset Password</h2>
        <p class="text-sm text-gray-400">Forgot your password? We'll send you a reset link</p>
    </div>

    <div class="mb-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-lg">
        <p class="text-sm text-gray-300">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-300" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <button type="submit" class="w-full mt-6 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
            {{ __('Send Reset Link') }}
        </button>

        <p class="text-center text-sm text-gray-400 mt-4">
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors">Back to login</a>
        </p>
    </form>
</x-guest-layout>
