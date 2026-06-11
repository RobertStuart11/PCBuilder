<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-1">Welcome Back</h2>
        <p class="text-sm text-gray-400">Sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-300" />
            <x-text-input 
                id="email" 
                class="block mt-2 w-full px-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="you@example.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input 
                id="password" 
                class="block mt-2 w-full px-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-2">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="w-4 h-4 bg-slate-700 border-slate-600 rounded accent-blue-500 cursor-pointer" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-400 hover:text-gray-300">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full mt-6 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
            {{ __('Sign in') }}
        </button>

        <!-- Divider -->
        <div class="relative flex items-center my-6">
            <div class="flex-grow border-t border-slate-600"></div>
            <span class="px-3 text-xs text-gray-400">or</span>
            <div class="flex-grow border-t border-slate-600"></div>
        </div>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-400">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors">
                Create one now
            </a>
        </p>
    </form>
</x-guest-layout>
