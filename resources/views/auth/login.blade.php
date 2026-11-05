
<x-guest-layout>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Figtree', sans-serif;
    }

    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background:
            radial-gradient(circle at 10% 10%, #e5eee7, transparent 35%),
            #f5f6f1;
    }

    .login-card {
        width: 100%;
        max-width: 1050px;
        min-height: 620px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(20, 50, 35, .13);
        border: 1px solid rgba(255,255,255,.8);
    }

    /* BRANDING */

    .brand-panel {
        background: #123c2b;
        color: white;
        padding: 48px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .brand-panel::before {
        content: "";
        position: absolute;
        width: 380px;
        height: 380px;
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 50%;
        right: -180px;
        top: 120px;
    }

    .brand-panel::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 50%;
        right: -100px;
        top: 170px;
    }

    .brand-logo {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 2px;
        position: relative;
        z-index: 2;
    }

    .brand-logo span {
        color: #d5b77a;
    }

    .brand-tagline {
        color: #c7d2c9;
        font-size: 10px;
        letter-spacing: 4px;
        margin-top: 7px;
    }

    .brand-content {
        position: relative;
        z-index: 2;
    }

    .brand-label {
        color: #d5b77a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .brand-content h2 {
        font-size: 43px;
        line-height: 1.18;
        font-weight: 700;
        margin: 20px 0;
    }

    .brand-content h2 span {
        color: #d5b77a;
    }

    .brand-content p {
        color: #c6d2ca;
        font-size: 14px;
        line-height: 1.9;
        max-width: 350px;
    }

    .brand-footer {
        color: #aabbb0;
        font-size: 11px;
        position: relative;
        z-index: 2;
    }

    /* LOGIN PANEL */

    .form-panel {
        padding: 65px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .mobile-logo {
        display: none;
    }

    .form-label {
        color: #b08c4b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .form-heading {
        font-size: 34px;
        font-weight: 700;
        color: #172b21;
        margin: 13px 0 8px;
    }

    .form-subtitle {
        font-size: 13px;
        color: #849087;
        margin-bottom: 35px;
    }

    .field-group {
        margin-bottom: 23px;
    }

    .field-group label {
        display: block;
        color: #263c30;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .input-wrap {
        position: relative;
    }

    .login-input {
        width: 100%;
        height: 51px;
        border: 1px solid #e2e8e2;
        background: #f8faf7;
        border-radius: 10px;
        padding: 0 15px;
        font-size: 13px;
        color: #24372b;
        outline: none;
        transition: .25s;
    }

    .login-input:focus {
        border-color: #285b40;
        background: white;
        box-shadow: 0 0 0 3px rgba(18,60,43,.08);
    }

    .login-input::placeholder {
        color: #a6afa8;
    }

    .password-input {
        padding-right: 65px;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #285b40;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .password-toggle:hover {
        color: #b08c4b;
    }

    .remember-row {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #66736a;
        font-size: 12px;
        margin: 4px 0 25px;
        cursor: pointer;
    }

    .remember-row input {
        width: 15px;
        height: 15px;
        accent-color: #123c2b;
        cursor: pointer;
    }

    .login-button {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 10px;
        background: #123c2b;
        color: white;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .4px;
        cursor: pointer;
        transition: .3s;
        box-shadow: 0 8px 18px rgba(18,60,43,.14);
    }

    .login-button:hover {
        background: #1d533b;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(18,60,43,.20);
    }

    .form-bottom {
        text-align: center;
        color: #a0aaa2;
        font-size: 11px;
        margin-top: 30px;
    }

    .error-message {
        color: #dc4444;
        font-size: 12px;
        margin-top: 7px;
    }

    /* TABLET & MOBILE */

    @media (max-width: 850px) {
        .login-card {
            max-width: 520px;
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .brand-panel {
            display: none;
        }

        .form-panel {
            padding: 45px 35px;
        }

        .mobile-logo {
            display: block;
            text-align: center;
            margin-bottom: 40px;
        }

        .mobile-logo h1 {
            color: #123c2b;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .mobile-logo h1 span {
            color: #d5b77a;
        }

        .mobile-logo p {
            font-size: 10px;
            letter-spacing: 3px;
            color: #929c94;
            margin-top: 5px;
        }

        .form-heading {
            font-size: 30px;
        }
    }

    @media (max-width: 480px) {
        .login-page {
            padding: 20px 13px;
        }

        .login-card {
            border-radius: 18px;
        }

        .form-panel {
            padding: 35px 23px;
        }

        .mobile-logo {
            margin-bottom: 32px;
        }

        .form-heading {
            font-size: 27px;
        }

        .form-subtitle {
            margin-bottom: 27px;
        }
    }
</style>


<div class="login-page">

    <div class="login-card">

        <!-- LEFT BRAND PANEL -->

        <div class="brand-panel">

            <div>
                <div class="brand-logo">
                    RV<span>.</span>STORE
                </div>

                <div class="brand-tagline">
                    PREMIUM FASHION COLLECTION
                </div>
            </div>

            <div class="brand-content">

                <div class="brand-label">
                    Welcome Back
                </div>

                <h2>
                    Your Store.<br>
                    Your Vision.<br>
                    <span>Your Success.</span>
                </h2>

                <p>
                    Manage your fashion business with confidence.
                    Control products, categories, inventory and
                    everything that makes your store special.
                </p>

            </div>

            <div class="brand-footer">
                © {{ date('Y') }} RV Store. All rights reserved.
            </div>

        </div>


        <!-- RIGHT LOGIN PANEL -->

        <div class="form-panel">

            <!-- MOBILE LOGO -->

            <div class="mobile-logo">
                <h1>RV<span>.</span>STORE</h1>
                <p>ADMIN PANEL</p>
            </div>


            <div>
                <div class="form-label">
                    Admin Portal
                </div>

                <h2 class="form-heading">
                    Welcome Back!
                </h2>

                <p class="form-subtitle">
                    Sign in to access your admin dashboard.
                </p>
            </div>


            <!-- SESSION STATUS -->

            <x-auth-session-status
                class="error-message"
                :status="session('status')"
            />


            <!-- LOGIN FORM -->

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->

                <div class="field-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="login-input"
                        placeholder="Enter your email"
                        required
                        autofocus
                        autocomplete="username"
                    >

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="error-message"
                    />

                </div>


                <!-- PASSWORD -->

                <div class="field-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrap">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="login-input password-input"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword(event)"
                        >
                            Show
                        </button>

                    </div>

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="error-message"
                    />

                </div>


                <!-- REMEMBER ME -->

                <!-- <label for="remember_me" class="remember-row">

                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                    >

                    Remember me

                </label> -->


                <!-- SUBMIT BUTTON -->

                <button type="submit" class="login-button">
                    Sign In to Dashboard &nbsp; →
                </button>

            </form>


            <div class="form-bottom">
                Secure Admin Access · RV Store
            </div>

        </div>

    </div>

</div>


<script>
    function togglePassword(event) {

        const password = document.getElementById('password');
        const button = event.currentTarget;

        const isHidden = password.type === 'password';

        password.type = isHidden ? 'text' : 'password';
        button.textContent = isHidden ? 'Hide' : 'Show';

    }
</script>

</x-guest-layout>
