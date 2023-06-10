@extends('layouts.main')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            @if(session()->has('success'))
            <div class="p-3 mt-2 mb-2 bg-success text-white">{{ session()->get('success') }}</div>
            @endif
            @if(session()->has('error'))
            <div class="p-3 mt-2 mb-2 bg-danger text-white">{{ session()->get('error') }}</div>
            @endif
            <h4 class="mb-4 mt-4">Ubah Password</h4>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        
                        <div class="card-body">
                            <form method="POST" action="/ubahPassword/commit">
                                @csrf
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password Lama') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="oldPassword" required minlength="8" autocomplete="old-password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="8" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Ubah Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</main>
@endsection