@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-6 pt-sm-3">
            <div class="card shadow h-100">
                <div class="h4 card-header">Enter city</div>
                <div class="card-body">
                    <form action="{{ route('frontier.login') }}" method="POST">@csrf
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" name="username" />
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="remember" type="checkbox" checked />
                                <label class="custom-control-label">Remember me</label>
                            </div><a class="nav-link-inline font-size-sm" href="#password-reset">Forgot
                                password?</a>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Sign In</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 pt-5 pt-sm-3">
            <div class="card shadow">
                <div class="h4 card-header">First time here? Sign up</div>
                <div class="card-body">
                    <form class="row g-2" action="{{ route('frontier.register') }}" method="POST">@csrf
                        <div class="col-sm-6">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control" name="first_name" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Last name</label>
                            <input type="text" class="form-control" name="last_name" />
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <input class="form-control" type="email" name="email" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" />
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="character" type="checkbox" checked />
                                <label class="custom-control-label">Also, create a character</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Sign Up</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
