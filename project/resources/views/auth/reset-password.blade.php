<form method="POST" action="{{ route('password.store') }}" class="password-reset-form">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div class="form-group">
        <x-input-label class="label" for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="error-message" />
    </div>

    <!-- Password -->
    <div class="form-group mt-4">
        <x-input-label class="label" for="password" :value="__('Password')" />
        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="error-message" />
    </div>

    <!-- Confirm Password -->
    <div class="form-group mt-4">
        <x-input-label class="label" for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
    </div>

    <div class="form-actions">
        <x-primary-button class="reset-button">
            {{ __('Reset Password') }}
        </x-primary-button>
    </div>
</form>

<style>
/* Password Reset Page Styling */
.password-reset-form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    background-color: #f9f9f9;
}

.label {
    color: white;
}

.password-reset-form h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 22px;
}

.password-reset-form p {
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
}

.password-reset-form .form-group {
    width: 100%;
    margin-bottom: 20px;
    text-align: left;
}

.password-reset-form .form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.password-reset-form .form-control:focus {
    border-color: #6a11cb;
    outline: none;
    box-shadow: 0 0 5px rgba(106, 17, 203, 0.6);
}

.password-reset-form .error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}

.password-reset-form .form-actions {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.reset-button {
    padding: 12px 24px;
    background: white;
    color:  #6a11cb;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
}

.reset-button:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    transform: scale(1.05);
}

.reset-button:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(106, 17, 203, 0.6);
}

.form-group .input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

/* Adding subtle gradient to background */
body {
    background: white;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}
</style>


