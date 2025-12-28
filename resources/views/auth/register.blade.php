<x-guest-layout>


        {{-- BRAND --}}
        <div class="brand-row">
            <div class="brand-icon">
                <i class="bi bi-car-front-fill text-primary fs-4"></i>
            </div>
            <span class="fw-bold text-primary fs-4">FKPark</span>
        </div>

        <div class="auth-title">
           Register an account
        </div>
        <div class="auth-subtitle">
            Join us today and start managing your campus parking experience at
            Universiti Malaysia Pahang.
        </div>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label small text-muted">Full name</label>
            <div class="position-relative">
                <i class="bi bi-person position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <x-text-input
                    id="name"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Adam Ali"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label class="form-label small text-muted">Email address</label>
            <div class="position-relative">
                <i class="bi bi-envelope position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username"
                    placeholder="adam@gmail.com"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="form-label small text-muted">Password</label>
            <div class="position-relative">
                <i class="bi bi-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="mb-4">
            <label class="form-label small text-muted">Confirm password</label>
            <div class="position-relative">
                <i class="bi bi-shield-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        {{-- CTA --}}
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary fw-semibold">
                Create account
            </button>
        </div>

        {{-- FOOT LINKS --}}
        <div class="text-center small">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                Login
            </a>
        </div>

    </form>

</x-guest-layout>
