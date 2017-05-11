<div class="grid_1">
@foreach($locales as $key => $local)

  <div class="col-md-4 col-xs-12 box_1">
    <a href="#"><img src="{{ asset('uploads/photos/'.$local->getFirsthPhoto()) }}" class="img-responsive" alt="{{ $local->getFirsthPhoto() }}"></a>
      <div class="box_2">
          <div class="special-wrap">
              <div class="forclosure"><span class="m_12 box-number box-price">{{ '$ '.$local->sumPrice() }}</span></div>
              @if($local->reservation_web)<div class="forclosure"><span class="m_13 bg-nav">Reserva Online</span></div>@endif
          </div>
      </div>
     <div class="box_3">
         <h4><a href="#">{!! ($key + 1).'. '.$local->name !!}</a></h4>

          <div class="boxed_mini_details clearfix">

            <span class="area first"><strong>Precio</strong><br>{{ number_format($local->score->avg('price'), 1, '.', '').'/5' }}</span>
            <span class="area first"><strong>Servicio</strong><br>{{ number_format($local->score->avg('service'), 1, '.', '').'/5' }}</span>
            <span class="status"><strong>Ambiente</strong><br>{{ number_format($local->score->avg('environment'), 1, '.', '').'/5' }}</span>
            <span class="bedrooms last"><strong>Atención</strong><br>{{ number_format($local->score->avg('attention'), 1, '.', '').'/5' }}</span>

          </div>

     </div>
  </div>
@endforeach
  <div class="clearfix"> </div>
</div>
