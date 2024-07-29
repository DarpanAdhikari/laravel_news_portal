<x-guest-layout>
    @push('app_name')
        // Register
    @endpush
    <form method="POST" action="{{ route('register') }}" class="login__form">
        @csrf
        <h1 class="login__title text-sm">Register</h1>
        <div class="flex flex-row justify-center space-x-4 social-login">
            <a href="auth/google/redirect"
                class="text-white bg-[#4285F4] w-full hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
                <svg fill="#fff"  class="w-4 h-4 me-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"><path d="M22.60229,10.00391a1.00005,1.00005,0,0,0-.98388-.82227H12.2a.99974.99974,0,0,0-1,1V14.0498a.99974.99974,0,0,0,1,1h3.9624a3.65162,3.65162,0,0,1-1.13183,1.1875A5.0604,5.0604,0,0,1,12.2,17.02246a4.93525,4.93525,0,0,1-4.64624-3.4378L7.55347,13.583a4.90382,4.90382,0,0,1,0-3.167l.00024-.00165A4.9356,4.9356,0,0,1,12.2,6.97754,4.37756,4.37756,0,0,1,15.3313,8.19531a1.00053,1.00053,0,0,0,1.39844-.01562L19.5979,5.31152a.99918.99918,0,0,0-.02539-1.43847A10.62342,10.62342,0,0,0,12.2,1,10.949,10.949,0,0,0,2.37134,7.05878l-.00147.00177A10.92175,10.92175,0,0,0,1.2,12a11.07862,11.07862,0,0,0,1.16992,4.93945l.00147.00177A10.949,10.949,0,0,0,12.2,23a10.5255,10.5255,0,0,0,7.29468-2.687l.00073-.00049.00079-.00085.00019-.00013.00006-.00012a10.78575,10.78575,0,0,0,3.30365-8.08386A12.51533,12.51533,0,0,0,22.60229,10.00391ZM12.2,3a8.68219,8.68219,0,0,1,5.2085,1.67285L15.95483,6.126A6.46322,6.46322,0,0,0,12.2,4.97754,6.88648,6.88648,0,0,0,6.21069,8.52832L5.14148,7.69958l-.585-.45367A8.95257,8.95257,0,0,1,12.2,3ZM3.67944,14.90332a9.02957,9.02957,0,0,1,0-5.80664l1.78223,1.38184a6.85381,6.85381,0,0,0,0,3.042ZM12.2,21A8.9528,8.9528,0,0,1,4.5564,16.75391l.37841-.29352,1.27588-.98969A6.88482,6.88482,0,0,0,12.2,19.02246a7.27662,7.27662,0,0,0,3.30573-.75079L17.19739,19.585A8.88989,8.88989,0,0,1,12.2,21Zm6.52588-2.76074-.183-.142L17.16553,17.028a5.60626,5.60626,0,0,0,1.39966-2.79553.9998.9998,0,0,0-.9834-1.18262H13.2V11.18164h7.54883c.03418.3457.05127.69531.05127,1.0459A9.05156,9.05156,0,0,1,18.72583,18.23926Z"/></svg>
                with Google
            </a>
        </div>
        <div class="or-text">OR</div>
        <x-validation-errors class="mb-3" />
        <div class="login__inputs">
            <div class="login__box" @error('name') style="border-color: red;" @enderror>
                <input type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name"
                    class="login__input" placeholder="Your full Name" required />
                <i class="fas fa-user-tag"></i>
            </div>
            <div class="login__box" @error('email') style="border-color: red;" @enderror>
                <input type="email" name="email" value="{{ old('email') }}" autocomplete="username"
                    class="login__input" placeholder="Your Email" required />
                <i class="fas fa-envelope"></i>
            </div>
            <div class="login__box" @error('password') style="border-color: red;" @enderror>
                <input type="password" name="password" autocomplete="new-password" class="login__input"
                    placeholder="New password" required />
                <i class="fas fa-lock"></i>
            </div>

            <div class="login__box">
                <input class="login__input" type="password" name="password_confirmation" placeholder="Confirm password"
                    required autocomplete="new-password" />
                <i class="fas fa-lock"></i>
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' =>
                                    '<a target="_blank" href="' .
                                    route('terms.show') .
                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                    __('Terms of Service') .
                                    '</a>',
                                'privacy_policy' =>
                                    '<a target="_blank" href="' .
                                    route('policy.show') .
                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                    __('Privacy Policy') .
                                    '</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
        @endif

        <button type="submit" class="login__button">Register</button>

        <div class="login__register">
            Already registered ? <a href="{{ route('login') }}">Log In</a>
        </div>
    </form>
</x-guest-layout>
