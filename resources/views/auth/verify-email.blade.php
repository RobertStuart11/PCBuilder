<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white mb-1">Verify Email</h2>
        <p class="text-sm text-gray-400">Check your email for verification link</p>
    </div>

    <div class="mb-6 p-4 bg-cyan-500/10 border border-cyan-500/20 rounded-lg">
        <p class="text-sm text-gray-300">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-500/10 border border-green-500/30 rounded-lg">
            <p class="text-sm font-medium text-green-400">
                {{ __("A new verification link has been sent to the email address you provided during registration.") }}
            </p>
        </div>
    @endif

    <div class="space-y-3 mt-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2.5 bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-500/50">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2.5 bg-slate-700/50 hover:bg-slate-700 text-gray-300 font-semibold rounded-lg border border-slate-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-slate-500/50">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
