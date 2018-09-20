@extends('layouts.app')

@section('css')
    <style>
        #ntpc-logo {
            transform: scale(1);
            transition: all 0.2s linear;
        }
        #ntpc-logo:hover {
            transform: scale(1.3);
        }
        #ntpc-openid:before {
            content: '或';
            background-color: #ffffff;
            display: block;
            position: absolute;
            padding: 15px 0;
            font-size: 1.2rem;
            left: 0;
            transform: translateX(-50%);
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <div class="card">
            <div class="card-header">登入</div>

            <div class="card-body d-flex">
                <div class="col">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-sm-right">帳號</label>

                            <div class="col-sm-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="請輸入 email" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label text-md-right">密碼</label>

                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="請輸入密碼" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    登入
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    忘記密碼？
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-center align-items-center ml-5 border-left" id="ntpc-openid">
                    <form method="POST" action="{{ route('ntpcopenid.login.start') }}">
                        @csrf

                        <button type="submit" class="btn bg-transparent">
                            <img src="{{ asset('images/ntpc.png') }}" id="ntpc-logo">
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection




