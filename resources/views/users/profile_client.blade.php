@extends('layouts.frontend')

@section('page-title', trans('app.profile'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h4 class="title">{{ trans('app.profile') }}</h4>
      </div>
      <div class="content">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 profile_avatar">
              {!! Form::model($user, ['route' => ['update.avatar', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal',  'files' => 'true']) !!}
                  <div class="img-responsive avatar-view">
                        <img class="avatar-view-img" id="avatar-view-img" src="{!! $user->avatar() !!}" height="190" alt="Avatar">
                  </div>
                  <br/>
                  <input style="display: none;" type="file" id="profile_image" name="avatar" value=""/>
                  <br/>
                  <button style="display: none;" type="submit" id="submit_image" class="btn btn-danger col-md-12 col-sm-12 col-xs-12"> @lang('app.change_photo')
                  </button>  
              {!! Form::close() !!}
            </div>

            <div class="col-md-7 col-sm-7 col-xs-12">
                {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT', 'class' => 'form-general']) !!}

                <div class="row">

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.name') </label>
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                    </div>
                  </div>

                   <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.last_name') </label>
                        {!! Form::text('lastname', old('lastname'), ['class' => 'form-control', 'id' => 'lastname']) !!}
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.email') </label>
                        {!! Form::text('email', old('email'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email', 'readOnly' => 'readOnly']) !!}
                    </div>
                  </div>

                  <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.birthday') </label>
                        {!! Form::text('birthday', isset($user->birthday) ? $user->birthday : old('birthday'), ['class' => 'form-control birthday', 'id' => 'birthday', 'data-inputmask' => "'mask' : '99-99-9999'"]) !!}
                    </div>
                  </div> 

                </div>

                <div class="row">

                 <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.phone_mobile') </label>
                        {!! Form::text('phone', old('phone'), ['class' => 'form-control phones', 'id' => 'mobile', 'data-inputmask' => "'mask' : '9999999999'"]) !!}
                    </div>
                 </div>

                 <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Género </label>
                        {!! Form::select('gender', ['' => 'Seleccionar', 'F' => 'Femenino', 'M' => 'Masculino'], old('gender'), ['class' => 'form-control', 'id' => 'gender']) !!}
                    </div>
                  </div>  

                </div> 

                <div class="row">

                 <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>@lang('app.address') 1</label>
                        {!! Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'address']) !!}
                    </div>
                 </div>

                 <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                          <label>@lang('app.address') 2</label>
                        {!! Form::text('address2', old('address2'), ['class' => 'form-control', 'id' => 'address2']) !!}
                    </div>
                  </div>  

                </div> 

                <div class="row">

                 <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Provincias </label>
                        {!! Form::select('province_id', $provinces, old('province_id'), ['class' => 'form-control', 'id' => 'province_id']) !!}
                    </div>
                  </div>  

                </div>

                <div class="row">   
                <div class="col-md-12 col-xs-12">
                  <button type="submit" class="btn btn-danger btn-fill menu-click pull-left">@lang('app.update')</button>
                  <a href="{{ route('user.password') }}" class="btn btn-info btn-fill menu-click pull-right">@lang('app.auth_and_registration')</a>
                </div>
                </div>

                <div class="clearfix"></div>

               {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<!-- jquery.inputmask -->
 {!! HTML::script('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}

 <!-- bootstrap-daterangepicker -->
 {!! HTML::script('vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

<script type="text/javascript">

  $(document).on('click', '.avatar-view', function () {
    $("#profile_image").trigger('click');
  });

  $(document).on('change', '#profile_image', function () {
    $("#submit_image").show();
    showLoading();
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#avatar-view-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
    hideLoading();
  });

  $(document).on('click', '#submit_image', function () {
    showLoading();
  });

  $(".phones").inputmask();
  $(".birthday").inputmask();
  

</script>
@endsection