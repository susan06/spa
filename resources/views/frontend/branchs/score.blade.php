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

                @if(isset($score) && $score == 'price')
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->avg_price) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                @if(isset($score) && $score == 'service')
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->avg_service) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                @if(isset($score) && $score == 'environment')
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->avg_environment) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                @if(isset($score) && $score == 'attention')
                <div class="star-rating">
                @for($i=1; $i <= 5; $i++)
                  <a href="#" class="{{ ($i <= $local->avg_attention) ? 'active' : '' }}">&#9733;</a>
                @endfor
                </div>
                @endif

              <div class="area first promedio">
                <strong class="{{ (isset($score) && $score == 'price') ? 'negrita' : '' }}">Precio</strong><br><span class="{{ (isset($score) && $score == 'price') ? 'negrita' : '' }}">{{ number_format($local->avg_price, 1, '.', '').'/5' }}</span>
              </div>
              <div class="area first promedio">
                <strong class="{{ (isset($score) && $score == 'service') ? 'negrita' : '' }}">Servicio</strong><br><span class="{{ (isset($score) && $score == 'service') ? 'negrita' : '' }}">{{ number_format($local->avg_service, 1, '.', '').'/5' }}</span>
              </div>
              <div class="area first promedio">
                <strong class="{{ (isset($score) && $score == 'environment') ? 'negrita' : '' }}">Ambiente</strong><br><span class=" {{ (isset($score) && $score == 'environment') ? 'negrita' : '' }}">{{ number_format($local->avg_environment, 1, '.', '').'/5' }}</span>
              </div>
              <div class="area last promedio">
                <strong class="{{ (isset($score) && $score == 'attention') ? 'negrita' : '' }}">Atención</strong><br><span class="{{ (isset($score) && $score == 'attention') ? 'negrita' : '' }}">{{ number_format($local->avg_attention, 1, '.', '').'/5' }}</span>
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
