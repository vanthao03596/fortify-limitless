<x-guest-layout>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content-inner">
                <div class="content d-flex justify-content-center align-items-center">
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-pill p-3 mb-3 mt-1"></i>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{ old('email') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-check text-muted"></i>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="text" name="email" class="form-control @error('email')is-invalid @enderror" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-mail5 text-muted"></i>
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

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="icon-plus3 mr-2"></i>{{ __('Register') }}</button>
                                </div>
                                
                                <div class="form-group text-center text-muted content-divider">
									<span class="px-2">{{ __('Already registered?') }}</span>
								</div>

                                <div class="form-group">
									<a href="{{ route('login') }}" class="btn btn-light btn-block"><i class="icon-circle-right2 mr-2"></i>{{ __('Log in') }}</a>
								</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>