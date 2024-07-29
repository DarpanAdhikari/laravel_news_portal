<x-guest-layout>
    @push('app_name')
    // Password forgotten
@endpush
<form method="POST" action="{{ route('password.email') }}" class="login__form">
    @csrf
    
    <div class="mb-2 text-sm text-gray">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <div class="login__box mb-2">
        <input class="login__input" name="email" :value="old('email')" required autofocus autocomplete="username"/>
        <i class="fas fa-envelope"></i>
     </div>
     <button type="submit" class="login__button">Send reset link</button>
</form>
</x-guest-layout>