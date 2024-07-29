<x-guest-layout>
    @push('app_name')
    // Reset
@endpush
<form method="POST" action="{{ route('password.update') }}" class="login__form">
    @csrf
    <x-validation-errors class="mb-3" />
    <div class="login__inputs">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="login__box">
            <input class="login__input" placeholder="Enter your email" type="email" name="email"
                value="{{old('email', $request->email)}}" autofocus autocomplete="email" required readonly />
            <i class="fas fa-envelope"></i>
        </div>

        <div class="login__box">
            <input class="login__input" placeholder="New password" type="password" name="password" required
                autocomplete="new-password" />
            <i class="fas fa-lock"></i>
        </div>

        <div class="login__box">
            <input class="login__input" placeholder="Confirm Password" type="password" name="password_confirmation"
                required autocomplete="new-password" />
            <i class="fas fa-lock"></i>
        </div>
    </div>
    <button type="submit" class="login__button">Reset</button>
</form> 
</x-guest-layout>
