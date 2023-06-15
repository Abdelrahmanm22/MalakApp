@include('front.includes.header')
    <!--Start Content-->
    <main
      class="main-content"
      style="background-image: url(front/assets/images/background.png)"
    >
      <div class="container">
        <div class="fatwas">
          <div class="maintitle">
            <h1>الفتاوى</h1>
          </div>
          <div class="questions" src="{{URL::asset('front/assets/images/background.png')}}">
            @foreach($rules as $r)
            <qa-modal
              shown-question="{{$r->question}}"
            >
              <p slot="q">
                {{$r->questionDetails}}
              </p>
              <p slot="a">
                {{$r->answer}}
              </p>
            </qa-modal>
            @endforeach
            
          </div>
        </div>
      </div>
      @include('front.includes.footer')