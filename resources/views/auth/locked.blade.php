@extends('layouts.app', [
    'class' => 'login-page',
    'elementActive' => '',
    'backgroundImagePath' => 'img/bg/bg.jpg'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">

                <form class="form" method="POST" action="{{ route('login.unlock') }}">
                    @csrf
                    <div class="card card-login">
                        <div class="card-header ">
                            <div class="card-header ">
                                <h3 class="header text-center">{{Auth::user()->name}}</h3>
                            </div>
                        </div>
                        <div class="card-header bg-transparent pb-5">
                              <img src="{{ asset('paper') }}/img/faces/erik-lucatero-1.jpg" class="card-login avatar rounded-circle" alt="">
                        </div>
                        <div class="card-body ">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->any() ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>

                                @if ($errors->any())
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning btn-round mb-3">{{ __('Sign in') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <a href="{{ route('password.request') }}" class="btn btn-link">
                    {{ __('Forgot password') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
