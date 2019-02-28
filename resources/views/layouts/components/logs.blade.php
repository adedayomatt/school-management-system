<section>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          @if(session('success'))
          <div class="alert alert-success">
              {!!session('success')!!}
          </div>
        @endif

        @if(session('info'))
          <div class="alert alert-info">
              {!!session('info')!!}
          </div>
        @endif

        @if(session('warning'))
          <div class="alert alert-warning">
              {!!session('warning')!!}
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-error">
              {!!session('error')!!}
          </div>
        @endif

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
              <div class="alert alert-error">
                  {!!$error!!}
              </div>
            @endforeach      
        @endif

        </div>
      </div>
    </section>
