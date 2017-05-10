@extends('layouts.frontend')

@section('page-title', trans('app.home'))

@section('styles')
@endsection

@section('content')

<div class="carousel-header">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        @foreach($banners as $key => $banner)
          <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ ($key == 0) ? 'active' : '' }}"></li>
        @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
        @foreach($banners as $key => $banner)
          <div class="item {{ ($key == 0) ? 'active' : '' }}">
            <img class="first-slide" src="{{ asset('uploads/banners/'.$banner->name) }}" alt="{{ $banner->name }}">
            <div class="container">
              <div class="carousel-caption">
                <p> {{ $banner->details }}</p>
              </div>
            </div>
          </div>
        @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>

  <div class="end_pills">
    <!-- End Carousel Inner -->
    <ul class="nav nav-pills nav-justified">
        <li class="tab-ext active" data-url="{{ route('local.search', 'score=service') }}"><a href="#">Servicio</a></li>
        <li class="tab-ext" data-url="{{ route('local.search', 'score=environment') }}"><a href="#">Ambiente</a></li>
        <li class="tab-ext" data-url="{{ route('local.search', 'score=attention') }}"><a href="#">Atención</a></li>
        <li class="tab-ext" data-url="{{ route('local.search', 'score=price') }}"><a href="#">Precio</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div id="tab-content" class="grid-local">
        @include('frontend.branchs.list')
    </div>
  </div>
</div>


@stop

@section('scripts')

{!! HTML::script('assets/js/holder.min.js') !!}
{!! HTML::script('assets/js/ie10-viewport-bug-workaround.js') !!}

@endsection
