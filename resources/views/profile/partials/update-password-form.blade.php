<section>

    <!-- Header -->
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 mb-2">

            <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                 style="width:45px;height:45px;">
                <i class="bi bi-shield-lock text-success fs-5"></i>
            </div>

            <div>
                <h5 class="fw-bold mb-1">Update Password</h5>
                <p class="text-muted small mb-0">
                    Use a strong password to keep your admin account secure.
                </p>
            </div>

        </div>
    </div>


    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')


        <!-- Current Password -->
        <div class="mb-4">

            <label for="update_password_current_password"
                   class="form-label fw-semibold">
                Current Password
            </label>

            <div class="input-group">

                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="form-control form-control-lg
                    {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}"
                    placeholder="Enter current password"
                    autocomplete="current-password"
                >

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('update_password_current_password', this)"
                >
                    <i class="bi bi-eye"></i>
                </button>

                @if($errors->updatePassword->has('current_password'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('current_password') }}
                    </div>
                @endif

            </div>

        </div>


        <!-- New Password -->
        <div class="mb-4">

            <label for="update_password_password"
                   class="form-label fw-semibold">
                New Password
            </label>

            <div class="input-group">

                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="form-control form-control-lg
                    {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Enter new password"
                    autocomplete="new-password"
                >

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('update_password_password', this)"
                >
                    <i class="bi bi-eye"></i>
                </button>

                @if($errors->updatePassword->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('password') }}
                    </div>
                @endif

            </div>

        </div>


        <!-- Confirm Password -->
        <div class="mb-4">

            <label for="update_password_password_confirmation"
                   class="form-label fw-semibold">
                Confirm New Password
            </label>

            <div class="input-group">

                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control form-control-lg
                    {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}"
                    placeholder="Confirm new password"
                    autocomplete="new-password"
                >

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('update_password_password_confirmation', this)"
                >
                    <i class="bi bi-eye"></i>
                </button>

                @if($errors->updatePassword->has('password_confirmation'))
                    <div class="invalid-feedback">
                        {{ $errors->updatePassword->first('password_confirmation') }}
                    </div>
                @endif

            </div>

        </div>


        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3 mt-4">

            <button
                type="submit"
                class="btn btn-success rounded-pill px-4 py-2 fw-semibold"
            >
                <i class="bi bi-shield-check me-1"></i>
                Update Password
            </button>


            @if(session('status') === 'password-updated')

                <span class="text-success fw-semibold small">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Password updated successfully.
                </span>

            @endif

        </div>

    </form>


    <!-- Show / Hide Password -->
    <script>
        function togglePassword(inputId, button) {

            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');

            }
        }
    </script>

</section>