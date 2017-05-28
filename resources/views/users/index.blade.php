@extends('layouts.app')

@section('page-title', trans('app.users'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.users') }}</h4>
                <p class="category">{{trans('app.list_of_registered_users')}}</p>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label class="select">
                      {!! Form::select('role', $roles, old('role'), ['class' => 'form-control', 'id' => 'select_roles']) !!}
                      <i></i> </label>
                    </div>

                    @include('partials.status')
                    @include('partials.search') 

                  </div>

                  <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 mg-botom-15-movil">
                       <a href="javascript:void(0)" data-href="{{ route('user.create') }}" class="btn btn-danger btn-fill  create-edit-show" data-model="modal" title="@lang('app.create_user')">
                          @lang('app.add_user')
                      </a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="inner-spacer">
                      <div id="tab-content">
                        @include('users.list')
                      </div>
                    </div>
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
 
@endsection