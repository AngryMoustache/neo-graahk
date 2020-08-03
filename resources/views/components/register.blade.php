<div class="container">
    <div class="container-header">
        <h2 class="container-header-title">Register</h2>
    </div>

    <div class="container-body lube lube-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-input">
                    <label for="name">Name</label>
                    <input id="name" type="name" name="name" value="{{ old('name') }}">
                </div>

                @error('name')
                    <div class="form-error">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-input">
                    <label for="email">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}">
                </div>

                @error('email')
                    <div class="form-error">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-input">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" value="{{ old('password') }}">
                </div>

                @error('password')
                    <div class="form-error">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-input">
                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                </div>

                @error('password_confirmation')
                    <div class="form-error">
                        <span class="error">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="form-row" style="border: 0px; margin: 0; padding: 0;">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>
