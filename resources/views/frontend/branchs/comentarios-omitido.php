
		@if($comments->count() > 0)
		  <div class="col-md-12 col-xs-12">
		  	<div class="card">
			  	<div class="header">
			        <h4 class="title">Comentarios</h4>
			    </div>
			    <div class="content">	    
					<div class="row">
					  <div class="col-md-12 col-xs-12">
						   <div id="load-comments">
						   	@include('frontend.branchs.comments')
						   </div>
					  </div>
					</div>
				</div>
			</div>
		  </div>
		@endif