<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="موقع فضيلة الشيخ مالك وفيق خاص بدروس و خطب امام مسجد آل يحيى بمدينة السادس من اكتوبر"
    />
    <meta name="robots" content="index, follow" />
    <meta property="og:locale" content="ar_EG" />
    <meta property="og:title" content="فضيلة الشيخ مالك وفيق" />
    <meta
      property="og:description"
      content="موقع فضيلة الشيخ مالك وفيق خاص بدروس و خطب امام مسجد آل يحيى بمدينة السادس من اكتوبر"
    />
    
    
    <script src="{{URL::asset('front/dist/js/qa-modal-dist.js')}}"></script>
    <script src="{{URL::asset('front/dist/js/dropdown-menu-dist.js')}}"></script>
    <script type="module" src="{{URL::asset('front/dist/js/audio-player-dist.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('front/dist/css/styles-min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('front/dist/css/normalize-min-dist.css')}}" />
    <link
      rel="icon"
      type="image/png"
      sizes="998x507"
      href="{{URL::asset('front/assets/images/logo.png')}}"
    />

    <title>فضيلة الشيخ مالك وفيق</title>
  </head>
  <body>
    <!--Start Header-->
    <header
      class="header"
      style="background-image: url(/front/assets/images/header.webp)"
    >
      <div class="container">
        <nav class="navbar">
          <div class="logo">
            <a href="{{route('videos')}}">
              <img src="{{URL::asset('front/assets/images/black-logo.png')}}" alt="the website logo"
            /></a>
          </div>
          <ul>
            <li><a href="{{route('videos')}}">تسجيلات مرئية</a></li>
            <li><a href="{{route('voices')}}">تسجيلات صوتية</a></li>
            <li><a href="{{route('timeLectures')}}">مواعيد المحاضرات</a></li>
            <li><a href="{{route('fatawy')}}">الفتاوى</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <!--Start Hero-->
    <div class="hero">
      <img src="{{URL::asset('front/assets/images/hero.png')}}" alt="Hero background" />
    </div>
    <!--End Hero-->
    <!--End Header-->