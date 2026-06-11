<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-1">Create Account</h2>
        <p class="text-sm text-gray-400">Join PCBuilder and start building your dream PC</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-300" />
            <x-text-input 
                id="name" 
                class="block mt-2 w-full px-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="John Doe" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

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
                autocomplete="username"
                placeholder="you@example.com" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Role Selection -->
        <div>
            <x-input-label for="role" :value="__('Account Type')" class="text-gray-300" />
            <div class="mt-2 grid grid-cols-2 gap-3">
                <label class="relative flex items-center p-3 cursor-pointer bg-slate-700/50 border-2 border-slate-600 rounded-lg hover:border-blue-500/50 transition-all group">
                    <input type="radio" name="role" value="buyer" class="w-4 h-4 accent-blue-500" {{ old('role') === 'buyer' ? 'checked' : 'checked' }} required>
                    <div class="ms-3">
                        <p class="text-sm font-semibold text-white group-hover:text-blue-400">Buyer</p>
                        <p class="text-xs text-gray-400">Browse & build</p>
                    </div>
                </label>
                <label class="relative flex items-center p-3 cursor-pointer bg-slate-700/50 border-2 border-slate-600 rounded-lg hover:border-green-500/50 transition-all group">
                    <input type="radio" name="role" value="seller" class="w-4 h-4 accent-green-500" {{ old('role') === 'seller' ? 'checked' : '' }} required>
                    <div class="ms-3">
                        <p class="text-sm font-semibold text-white group-hover:text-green-400">Seller</p>
                        <p class="text-xs text-gray-400">Sell components</p>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-400" />
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
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <p class="mt-1 text-xs text-gray-500">Minimum 8 characters, mix of upper/lower case, numbers, and symbols</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
            <x-text-input 
                id="password_confirmation" 
                class="block mt-2 w-full px-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="••••••••" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start pt-2">
            <input type="checkbox" id="terms" name="terms" class="w-4 h-4 mt-1 bg-slate-700 border-slate-600 rounded accent-blue-500 cursor-pointer" required>
            <label for="terms" class="ms-2 text-xs text-gray-400">
                I agree to the <a href="#" class="text-blue-400 hover:text-blue-300">Terms of Service</a> and <a href="#" class="text-blue-400 hover:text-blue-300">Privacy Policy</a>
            </label>
        </div>

        <!-- Register Button -->
        <button type="submit" class="w-full mt-6 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50">
            {{ __('Create Account') }}
        </button>

        <!-- Divider -->
        <div class="relative flex items-center my-4">
            <div class="flex-grow border-t border-slate-600"></div>
            <span class="px-3 text-xs text-gray-400">or</span>
            <div class="flex-grow border-t border-slate-600"></div>
        </div>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-400">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>
