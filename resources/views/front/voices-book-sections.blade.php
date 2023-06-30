@include('front.includes.header')
    <!--Start Content-->
    <main class="main-content" style="background-image: url(/front/assets/images/background.png);">
      <div class="container">
        <div class="videos-books">
          <div class="maintitle">
            <h1>{{$myBook->name}}</h1>
          </div>
          <div class="book-sections">
            @foreach($sections as $s)
              <div class="section">
                <a href="{{url('voice/'.$s->section_id)}}">
                  <div class="name">{{$s->title}}</div>
                  <div class="count">{{$s->count}}</div>
                </a>
              </div>
            @endforeach

          </div>
        </div>
      </div>
      @include('front.includes.footer')