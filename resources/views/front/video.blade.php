@include('front.includes.header')
    <!--Start Content-->
    <main class="main-content" style="background-image: url(/front/assets/images/background.png);">
      <div class="container">
        <div class="videos-books">
          <div class="maintitle">
            <h1>{{$myVideo->title}}</h1>
          </div>
          <div class="section-video">
            <div class="video-container">
              @if($myVideo->iframe=="NULL")
                
                  <video controls controlsList="nodownload">
                    <source
                      src="{{URL::asset('files/videos').'/'.$myVideo->video}}"
                      type="video/mp4"
                    />
                  </video>
                
              @else
                
                  <iframe
                    width="1519"
                    height="591"
                    src="{{'https://www.youtube.com/embed/'.$myVideo->iframe}}"
                    title='صحيح البخاري " باب إفشاء السلام "'
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                  ></iframe>
                
              @endif
            </div>
            <p class="video-description">
              {{$myVideo->description}}
            </p>
          </div>
        </div>
      </div>
@include('front.includes.footer')