@include('front.includes.header')
    <!--Start Content-->
    <main class="main-content">
      <div class="container">
        <div class="bio-content">
          <p>
            {{$settings->cv}}
          </p>
        </div>
      </div>
    </main>
    <!--End Content-->
    @include('front.includes.footer')