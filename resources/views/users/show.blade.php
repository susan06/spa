@extends('layouts.app')

@section('page-title', trans('app.user'))

@section('content')

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="card">
      <div class="header">
          <h4 class="title">Detalles del usuario</h4>
      </div>
      <div class="content">
          <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 profile_avatar">
                  <div class="img-responsive avatar-view">
                        <img class="avatar-view-img" id="avatar-view-img" src="{!! $user->avatar() !!}" height="190" alt="Avatar">
                  </div>
            </div>

            <div class="col-md-7 col-sm-7 col-xs-12">

                <div class="row">

                  <table class="table table-hover table-striped" cellspacing="0" width="100%">
                            <tr>
                              <td><strong>@lang('app.roles'):</strong></td>
                              <td>
                                @foreach($user->roles->all() as $role)
                                  {{ $role->display_name.'. ' }}
                                @endforeach
                              </td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><strong>@lang('app.email'):</strong></td>
                              <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><strong>@lang('app.phone'):</strong></td>
                              <td>{{ $user->phone }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td><strong>@lang('app.birth'):</strong></td>
                              <td>{{ $user->birthday }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            @if($user->hasRole('client'))
                            @if($user->address)
                            <tr>
                              <td><strong>@lang('app.address') 1:</strong></td>
                              <td>{{ $user->address }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            @endif
                            @if($user->address2)
                            <tr>
                              <td><strong>@lang('app.address') 2:</strong></td>
                              <td>{{ $user->address2 }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                            @endif
                              @if($user->province_id)
                              <tr>
                                <td><strong>Provincia:</strong></td>
                                <td>{{ $user->province->name }}</td>
                                <td></td>
                                <td></td>
                              </tr>
                              @endif
                              @if($user->gender)
                              <tr>
                                <td><strong>Género:</strong></td>
                                <td>{{ ($user->gender && $user->gender == 'F') ? 'Femenino' : 'Masculino' }}</td>
                                <td></td>
                                <td></td>
                              </tr>
                              @endif
                            @endif
                            <tr>
                              <td><strong>@lang('app.last_logged_in'):</strong></td>
                              <td>{{ $user->last_login }}</td>
                              <td></td>
                              <td></td>
                            </tr>
                  </table>

                </div>

            </div>
          </div>
      </div>
    </div>
  </div>
</div>


@endsection
