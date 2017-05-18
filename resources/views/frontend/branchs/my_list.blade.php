<div class="grid_1 top">
@foreach($locales as $key => $local)

  <div class="col-md-4 col-xs-12 box_1">
    <a href="{{ route('local.show', $local->branchOffice->id) }}" class="menu-click"><img src="{{ asset('uploads/photos/'.$local->branchOffice->getFirsthPhoto()) }}" class="img-responsive menu-click" alt="{{ $local->branchOffice->getFirsthPhoto() }}"></a>
      <div class="box_2">
          <div class="special-wrap">
              <div class="forclosure"><span class="m_12 box-number box-price"><a href="{{ route('local.show', $local->branchOffice->id) }}" class="menu-click">{{ Settings::get('coin').' '.$local->branchOffice->sumPrice() }}</a></span></div>
              @if($local->branchOffice->reservation_web)<div class="forclosure"><span class="m_13 bg-nav">Reserva Online</span></div>@endif
          </div>
      </div>
     <div class="box_3">
         <h4><a href="{{ route('local.show', $local->branchOffice->id) }}" class="menu-click">
          {!! (($locales->currentpage()-1) * $locales->perpage() + $key + 1).'. '.$local->branchOffice->name !!}</a></h4>
         <p>{{ $local->branchOffice->address.'. '.$local->branchOffice->province->name }}</p>

         <div class="boxed_mini_details clearfix">


              <div class="area first promedio">
                <strong class="">Precio</strong><br><span class="">{{ number_format($local->branchOffice->score->avg('price'), 1, '.', '').'/5' }}</span>
              </div>
              <div class="area first promedio">
                <strong class="">Servicio</strong><br><span class="">{{ number_format($local->branchOffice->score->avg('service'), 1, '.', '').'/5' }}</span>
              </div>
              <div class="area first promedio">
                <strong class="">Ambiente</strong><br><span class="">{{ number_format($local->branchOffice->score->avg('environment'), 1, '.', '').'/5' }}</span>
              </div>
              <div class="area last promedio">
                <strong class="">Atención</strong><br><span class="">{{ number_format($local->branchOffice->score->avg('attention'), 1, '.', '').'/5' }}</span>
              </div>

          </div>

     </div>
  </div>
@endforeach
  <div class="clearfix"> </div>

  <div class="paginate">
  {!! $locales->links() !!}
  </div>

</div>
