<!DOCTYPE html>
<html>
@include('admin.includes.style')

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{route('admin.login.post')}}" method="POST"  data-parsley-validate="">
            @csrf
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" class="form-control"  name="email" placeholder="Email" required=""
                       maxlength="100" data-parsley-maxlength="100" value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input type="password" class="form-control" name="password" placeholder="Password"
                       maxlength="100" data-parsley-maxlength="100">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('password'))
                    <div class="error text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="row form-group">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input  type="checkbox" name="remember_me" value="1" @if( old('remember_me')!= null) checked @endif> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@include('admin.includes.script')
</body>
</html>
