@extends('layouts.app')

@section('content')



<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
               
                <h3 class="card-title text-left mb-3">{{ __('Login') }}</h3>
                 <form method="POST" action="{{ route('login') }}">
                        @csrf

                  <div class="form-group">
                    <label>{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control p_input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control p_input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  </div>
                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                       <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}</label>
                    </div>
                  
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">  {{ __('Login') }}</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

@endsection
