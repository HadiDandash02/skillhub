    <div class="password-reset-container">
        <div class="password-reset-box">
            <h2>{{ __('Forgot Your Password?') }}</h2>
            <p>
                {{ __('No problem. Just enter your email address below, and we’ll send you a link to reset your password.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="session-status" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="password-reset-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <div class="form-actions">
                    <x-primary-button class="reset-button">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
<style>
    /* Password Reset Page Styling */
.password-reset-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f4f4;
}

.password-reset-box {
  background: white;
  padding: 32px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

.password-reset-box h2 {
  color: #333;
  margin-bottom: 10px;
}

.password-reset-box p {
  color: #666;
  font-size: 14px;
  margin-bottom: 20px;
}

.password-reset-form .form-group {
  margin-bottom: 16px;
  text-align: left;
}

.password-reset-form .form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

.password-reset-form .error-message {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

.form-actions {
  display: flex;
  justify-content: center;
}

.reset-button {
  padding: 12px 24px;
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.reset-button:hover {
  background: linear-gradient(135deg, #2575fc, #6a11cb);
}

</style>