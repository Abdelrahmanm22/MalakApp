@include('front.includes.header')
    <!--Start Content-->
    <main
      class="main-content"
      style="background-image: url(/front/assets/images/background.png)"
    >
      <div class="container">
        <div class="section-voices">
          <div class="maintitle">
            <h1>{{$mySection->title}}</h1>
          </div>
          <div class="voices">
            @foreach($voices as $v)
              <audio-player src="{{URL::asset('files/voices').'/'.$v->audio}}">
                 {{$v->title}}
              </audio-player>
            @endforeach

          </div>
        </div>
      </div>
      @include('front.includes.footer')