<section>

    <!-- Header -->
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 mb-2">
            <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                 style="width:45px;height:45px;">
                <i class="bi bi-person text-success fs-5"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Profile Information</h5>
                <p class="text-muted small mb-0">
                    Update your admin account information and email address.
                </p>
            </div>
        </div>
    </div>


    <!-- Email Verification Form -->
    <form id="send-verification"
          method="POST"
          action="{{ route('verification.send') }}">
        @csrf
    </form>


    <!-- Profile Update Form -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')


        <!-- Name -->
        <div class="mb-4">

            <label for="name" class="form-label fw-semibold">
                <i class="bi bi-person me-1 text-success"></i>
                Admin Name
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control form-control-lg @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                placeholder="Enter admin name"
                required
                autofocus
                autocomplete="name"
            >

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Email -->
        <div class="mb-4">

            <label for="email" class="form-label fw-semibold">
                <i class="bi bi-envelope me-1 text-success"></i>
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control form-control-lg @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                placeholder="Enter email address"
                required
                autocomplete="username"
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Email Verification -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="alert alert-warning border-0 rounded-3">

                <div class="d-flex gap-2">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <div>

                        <div class="fw-semibold mb-1">
                            Email address is not verified
                        </div>

                        <button
                            type="submit"
                            form="send-verification"
                            class="btn btn-link text-success p-0 text-decoration-none fw-semibold"
                        >
                            Re-send verification email
                        </button>

                    </div>

                </div>

            </div>


            @if (session('status') === 'verification-link-sent')

                <div class="alert alert-success border-0 rounded-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    A new verification link has been sent to your email address.
                </div>

            @endif

        @endif


        <!-- Save -->
        <div class="d-flex align-items-center gap-3 mt-4">

            <button type="submit"
                    class="btn btn-success rounded-pill px-4 py-2 fw-semibold">

                <i class="bi bi-check-lg me-1"></i>
                Save Changes

            </button>


            @if (session('status') === 'profile-updated')

                <span class="text-success fw-semibold small">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Profile updated successfully.
                </span>

            @endif

        </div>

    </form>

</section>