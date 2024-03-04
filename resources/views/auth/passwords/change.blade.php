@extends('layouts.app')

@section('title')
    {{--{{ $site_setting->main_title }} ||--}} Change Password
@endsection

@section('content')

    <div class="container">

       {{-- @if(session('errorMsg'))

            <div class="alert alert-danger" role="alert">
                {{ session('errorMsg') }}
            </div>

        @endif--}}

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Your Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update.password') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="oldpass" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                                <div class="col-md-6">
                                    {{--<input id="oldpass" type="password" class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>
                                    @if ($errors->has('oldpass'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('oldpass') }}</strong>
                                            </span>
                                    @endif--}}
                                    <input id="oldpass" type="password" class="form-control{{-- @error('oldpass') is-invalid @enderror--}}" name="oldpass" required autofocus>
                                    {{--@error('oldpass')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif--}}
                                    <input id="password" type="password" class="form-control{{--@error('password') is-invalid @enderror--}}" name="password" required>
                                   {{-- @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror--}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{--{{ __('Reset Password') }}--}}
                                        {{ __('Update Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br /><br /><br />
@endsection
