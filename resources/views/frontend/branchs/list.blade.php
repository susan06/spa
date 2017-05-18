<div class="grid_1">
@foreach($locales as $key => $local)

  <div class="col-md-4 col-xs-12 box_1">
    <a href="{{ route('local.show', $local->id) }}" class="menu-click"><img src="{{ asset('uploads/photos/'.$local->getFirsthPhoto()) }}" class="img-responsive menu-click" alt="{{ $local->getFirsthPhoto() }}"></a>
      <div class="box_2">
          <div class="special-wrap">
              <div class="forclosure"><span class="m_12 box-number box-price"><a href="{{ route('local.show', $local->id) }}" class="menu-click">{{ Settings::get('coin').' '.$local->sumPrice() }}</a></span></div>
              @if($local->reservation_web)<div class="forclosure"><span class="m_13 bg-nav">Reserva Online</span></div>@endif
          </div>
      </div>
     <div class="box_3">
         <h4><a href="{{ route('local.show', $local->id) }}" class="menu-click">{!! (($locales->currentpage()-1) * $locales->perpage() + $key + 1).'. '.$local->name !!}</a></h4>
         <p> {{ $local->address.'. '.$local->province->name }}</p>

          <div class="boxed_mini_details clearfix">

            <div class="area first promedio"><strong>Precio</strong><br>{{ number_format($local->score->avg('price'), 1, '.', '').'/5' }}</div>
            <div class="area first promedio"><strong>Servicio</strong><br>{{ number_format($local->score->avg('service'), 1, '.', '').'/5' }}</div>
            <div class="area first promedio"><strong>Ambiente</strong><br>{{ number_format($local->score->avg('environment'), 1, '.', '').'/5' }}</div>
            <div class="area last promedio"><strong>Atención</strong><br>{{ number_format($local->score->avg('attention'), 1, '.', '').'/5' }}</div>

          </div>

     </div>
  </div>
@endforeach
  <div class="clearfix"> </div>

@if($paginate)
  <div class="paginate">
  {!! $locales->links() !!}
  </div>
@endif

</div>
