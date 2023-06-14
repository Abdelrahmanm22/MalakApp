@include('front.includes.header')
    <!--Start Content-->
    <main
      class="main-content"
      style="background-image: url(/front/assets/images/background.png)"
    >
    <div class="container">
        <div class="videos-books">
          <div class="maintitle">
            <h1>ابواب كتاب صحيح البخاري</h1>
          </div>
          <div class="book-sections">
            @foreach($sections as $s)
              <dropdown-menu class="dropdown-menu" data-name="{{$s->title}}">
                @foreach($videos as $v)
                  @if($s->section_id==$v->section_id)
                    <li><a href="{{url('video/'.$v->video_id)}}">{{$v->title}}</a></li>
                  @endif
                @endforeach
              </dropdown-menu>
            @endforeach

          </div>
        </div>
      </div>
@include('front.includes.footer')