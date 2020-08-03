<div class="container">
    <div class="container-header">
        <h2 class="container-header-title">Login</h2>
    </div>

    <div class="container-body lube lube-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

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

            <div class="form-row" style="border: 0px; margin: 0; padding: 0;">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</div>
