<x-guest-layout>

    {{-- STATUS --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    
        {{-- BRAND --}}
        <div class="brand-row">
            <div class="brand-icon">
                <i class="bi bi-car-front-fill text-primary fs-4"></i>
            </div>
            <span class="fw-bold text-primary fs-4">FKPark</span>
        </div>

        <div class="auth-title">
            Welcome back
        </div>

        <div class="auth-subtitle">
            Continue managing your campus parking experience at
            Universiti Malaysia Pahang.
        </div>



    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                    autofocus
                    autocomplete="username"
                    placeholder="adam@gmail.com"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- PASSWORD --}}
        <div class="mb-4">
            <label class="form-label small text-muted">Password</label>
            <div class="position-relative">
                <i class="bi bi-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="form-control ps-5"
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- OPTIONS --}}
        <div class="d-flex justify-content-between align-items-center mb-4 small">
            <label class="d-flex align-items-center gap-2 text-muted">
                <input type="checkbox" name="remember" class="form-check-input mt-0">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                    Forgot password?
                </a>
            @endif
        </div>

        {{-- CTA --}}
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary fw-semibold">
                Login
            </button>
        </div>



    </form>

</x-guest-layout>
