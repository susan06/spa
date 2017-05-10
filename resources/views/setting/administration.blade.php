@extends('layouts.app')

@section('page-title', trans('app.setting'))

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('app.setting') }}</h4>
                <p class="category">{{trans('app.manage_general_system_settings')}}</p>
            </div>
            <div class="content">
                @include('setting.administration_field')
            </div>
        </div>
      </div>
  </div>
</div>

@endsection

@section('styles')
    <!-- Switchery -->
    {!! HTML::style("vendors/switchery/dist/switchery.min.css") !!}
@endsection

@section('scripts')
    <!-- Switchery -->
    {!! HTML::script('vendors/switchery/dist/switchery.min.js') !!}
    <!-- Select2 -->
  {!! HTML::script('vendors/select2/dist/js/select2.full.min.js') !!}

  <script type="text/javascript">
    $(".select2_single").select2({
      placeholder: "@lang('app.selected_item')"
    });
  </script>

@endsection