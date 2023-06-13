@include('front.includes.header')

    <!--Start Content-->
    <main class="main-content">
      <div class="container">
        <div class="content">
          <ul>
            <li class="active" data-tab=".voices">تسجيلات صوتية</li>
            <li data-tab=".videos">تسجيلات مرئية</li>
          </ul>
          <div class="tab-content">
            <div class="voices active">
            @foreach($myVoices as $v)
              <audio-player src="{{URL::asset('files/voices/'.$v->audio)}}">
                {{$v->title}}
              </audio-player>
            @endforeach
              <!-- <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player>
              <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player>
              <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player>
              <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player>
              <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player>
              <audio-player src="./assets/voices/112 الاخلاص.mp3">
                سورة الاخلاص
              </audio-player> -->
            </div>
            <div class="videos">
              @foreach($myVideos as $v)
              <div class="video">
                <a href="{{url('video/'.$v->video_id)}}">
                  <p class="name">{{$v->title}}</p>
                  <p class="time">09:14</p>
                </a>
              </div>
              @endforeach
              <!-- <div class="video">
                <a href="./embed-video.html">
                  <p class="name">صحيح البخارى باب افشاء السلام</p>
                  <p class="time">09:14</p>
                </a>
              </div> -->
              <!-- <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div>
              <div class="video">
                <a href="">
                  <p class="name">فاضى</p>
                  <p class="time">00:00</p>
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--End Content-->
    @include('front.includes.footer')