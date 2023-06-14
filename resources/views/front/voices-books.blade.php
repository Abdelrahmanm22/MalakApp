@include('front.includes.header')
    <!--Start Content-->
    <main class="main-content" style="background-image: url(front/assets/images/background.png);">
      <div class="container">
        <div class="voices-books">
          <div class="maintitle">
            <h1>الكتب المسجلة صوتيًا</h1>
          </div>
          <div class="books">
            @foreach($myBooks as $b)
              <div class="book">
                <a href="{{url('sectionsVoices/'.$b->book_id)}}">
                  <div class="book-cover">
                    <img
                      src="{{URL::asset('files/books/'.$b->image)}}"
                      alt="صحيح البخارى"
                    />
                  </div>
                  <p class="name">{{$b->name}} </p>
                  <p class="description">
                    {{$b->type}}
                  </p>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      @include('front.includes.footer')