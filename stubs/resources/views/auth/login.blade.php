<x-guest-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" placeholder="{{ __('Password') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group d-flex align-items-center">
                                    <label class="custom-control custom-checkbox" for="remember_me">
                                        <input type="checkbox" name="remember" id="remember_me" class="custom-control-input" {{ old('remember_me') ? 'checked' : '' }}>
                                        <span class="custom-control-label">{{ __('Remember me') }}</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="ml-auto">{{ __('Forgot your password?') }}</a>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="icon-circle-right2 mr-2"></i>{{ __('Log in') }}</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>