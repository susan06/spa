@extends('layouts.app')

@section('page-title', 'comentarios')

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Comentarios del local: {{ $local->name }}</h4>
            </div>
            <div class="content">
                <div class="row">

                    <div class="inner-spacer">
                      <div id="tab-content">
                         <div class="col-md-7 col-xs-12">
                            @if (App::environment() === 'production')
                            <div id="disqus_thread"></div>

                            <script>
                            var disqus_config = function () {
                            this.page.url = '{{ route("local.show", $local->id) }}'; 
                            this.page.identifier = 'local-{{$local->id}}'; 
                            };
                            
                            (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = "{{ Settings::get('site_disqus') }}"; //https://kels-2.disqus.com/embed.js
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                            })();
                            </script>

                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            @endif
                        </div>
                      </div>
                    </div>
        
            </div>
        </div>
      </div>
  </div>
</div>

@endsection
