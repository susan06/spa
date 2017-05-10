<div class="grid_1">
@foreach($locales as $key => $local)

  <div class="col-md-3 col-xs-4 box_1">
    <a href="#"><img src="{{ asset('uploads/photos/'.$local->getFirsthPhoto()) }}" class="img-responsive" alt="{{ $local->getFirsthPhoto() }}"></a>
      <div class="box_2">
          <div class="special-wrap">
              <div class="forclosure"><span class="m_12 box-number">{{ 'Puntaje '.$local->sumScore() }}</span></div>
              @if($local->branchOffice->reservation_web)<div class="forclosure"><span class="m_13 bg-nav">Reserva Online</span></div>@endif
          </div>
      </div>
     <div class="box_3">
         <h4><a href="#">{!! ($key + 1).'. '.$local->branchOffice->name !!}</a></h4>

         <div class="boxed_mini_details clearfix">

                @if($score == 'price')
                <span class="status text-red">{{ '$ '.$local->sumPrice() }}</span>
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->price) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                @if($score == 'service')
                <span class="status"><strong class="text-red">{{ '$ '.$local->sumPrice() }}</strong></span>
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->service) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                @if($score == 'environment')
                <span class="status"><strong class="text-red">{{ '$ '.$local->sumPrice() }}</strong></span>
                <div class="star-rating">
                  @for($i=1; $i <= 5; $i++)
                    <a href="#" class="{{ ($i <= $local->environment) ? 'active' : '' }}">&#9733;</a>
                  @endfor
                </div>
                @endif

                 @if($score == 'attention')
                <span class="status"><strong class="text-red">{{ '$ '.$local->sumPrice() }}</strong></span>
                <div class="star-rating">
                @for($i=1; $i <= 5; $i++)
                  <a href="#" class="{{ ($i <= $local->attention) ? 'active' : '' }}">&#9733;</a>
                @endfor
                </div>
                @endif
          </div>

     </div>
  </div>
@endforeach
  <div class="clearfix"> </div>
</div>
