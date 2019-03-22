@extends('auth.contenido')
@section('login')
    <div class="login-box-body">
    <p class="login-box-msg">Inicie sesión para ingresar a PrimaxSoftware</p>

    <form method="POST" class="form-horizontal was-validated" action="{{ route('login') }}">
      {{ csrf_field()}}
      <div class="form-group has-feedback{{$errors->has('usuario' ? 'is-invalid' : '')}}">
        
        <input value="{{old('usuario')}}" type="text" class="form-control" placeholder="username" id="usuario" name="usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        {!!$errors->first('usuario','<span class="invalid-feedback text-danger">:message</span>')!!}
      </div>
      <div class="form-group has-feedback{{$errors->has('password' ? 'is-invalid' : '')}}" >
        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        {!!$errors->first('password','<span class="invalid-feedback text-danger">:message</span>')!!}
      </div>
      
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        
        <!-- /.col -->
      </div>
    </form>

    

    {{-- <a href="#">I forgot my password</a><br> --}}

  </div>
@endsection
