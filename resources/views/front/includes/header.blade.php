<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="موقع الشيخ مالك وفيق" />
    <meta name="robots" content="index, follow" />
    <meta property="og:locale" content="ar_EG" />
    <meta property="og:title" content="الشيخ مالك وفيق" />
    <meta property="og:description" content="موقع الشيخ مالك وفيق" />

    <script src="{{URL::asset('front/dist/js/audio-player.js')}}" type="module"></script>

    <link rel="stylesheet" href="{{URL::asset('front/dist/css/styles.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('front/dist/css/normalize.css')}}" />
    <link
      rel="icon"
      type="image/png"
      sizes="512x512"
      href="{{URL::asset('front/assets/icons/moslem.png')}}"
    />

    <title>الشيخ مالك وفيق</title>
  </head>
  <body>
    <!--Start Header-->
    <header class="header">
      <div class="container">
        <nav class="navbar">
          <ul>
            <li><a href="{{route('home')}}">الصفحة الرئيسية</a></li>
            <li><a href="{{route('biography')}}">السيرة الذاتية</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <!--End Header-->
    <!--Start Hero-->
    <div class="hero">
      <div class="container">
        <div class="content">
          <h1 class="main">{{$settings->name}}</h1>
          <h1 class="background">مالك وفيق</h1>
        </div>
      </div>
    </div>
    <!--End Hero-->