<x-guest-layout>

        {{-- BRAND --}}
        <div class="brand-row">
            <div class="brand-icon">
                <i class="bi bi-car-front-fill text-primary fs-4"></i>
            </div>
            <span class="fw-bold text-primary fs-4">FKPark</span>
        </div>

  
{{-- INFO TEXT --}}
    <div class="mb-4">
        <h5 class="fw-bold mb-1">Reset your password</h5>
        <p class="text-muted small mb-0">
            Enter your email address and we will send you a link to reset your password.
        </p>
    </div>

    {{-- SESSION STATUS --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- EMAIL --}}
        <div class="mb-4">
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
                    placeholder="you@example.com"
                    class="form-control ps-5"
                />
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- CTA --}}
        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary fw-semibold">
                Send reset link
            </button>
        </div>

        {{-- BACK --}}
        <div class="text-center small">
            <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">
                ← Back to login
            </a>
        </div>

    </form>

</x-guest-layout>
