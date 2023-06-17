<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic Page Needs
================================================== -->
  <meta charset="utf-8">
  <title> @yield('page_title') </title>

  <!-- Mobile Specific Metas
================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="description" content={{$page['description']}}>

  <meta name="keywords" content="{{$page['keywords']}}">
  <Meta name="robots" content="index, follow" />
  <meta name="googlebot" content="index, follow" />
  <Meta name="Yahoobot" content="index, follow" />
  <meta name="MSNbot" content="Index, Follow" />
  <meta name="allow-search" content="yes" />
  <Meta name="author" content="{{ $page['author']}}" />
  <Meta name="revisit-after" content="3 days"/>
  <Meta name="country" content="India"/>
  <Meta name= "geography" content ="{{$page['address']}}"/>
  <Meta name="contactNumber" content="{{$page['contact_number']}}"/>
  <Meta name="dc.language" content="english"/>
  <Meta name="geo.region" content="IN-BH" />
  <Meta name="geo.placename" content="Patna" />
  <Meta name="geo.position" content="" />
  <Meta name="ICBM" content="" />
  <meta property="og:url" content="{{$page['domain']}}" />
  <meta property="og:image" content="{{$page['domain']}}/assets/favicon.png"/>
  <meta property="og:type" content="{{$page['domain']}}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="{{$page['title']}}" />
  <meta property="og:description" content="{{$page['description']}}" />
  <meta property="og:keyword" content="{{$page['keywords']}}" />

  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/animate-css/animate.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/colorbox/colorbox.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

</head>
<body>
    <div class="body-inner">

        @include('landing.components.top-header')
        @include('landing.components.header')
        @if (Route::is('home'))
            @include('landing.components.hero-section')
        @else
            @include('landing.components.breadcrub')
        @endif

        @yield('content')
        @show

        @include('landing.components.footer')

        <script src="{{ asset('assets/plugins/jQuery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js')}}" defer></script>
        <script src="{{ asset('assets/plugins/slick/slick.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/slick/slick-animation.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/colorbox/jquery.colorbox.js')}}"></script>
        <script src="{{ asset('assets/plugins/shuffle/shuffle.min.js')}}" defer></script>

        <script src="{{ asset('assets/js/script.js')}}"></script>
        <script src="{{ asset("assets/php-email-form/validate.js")}}"></script>

    </div><!-- Body inner end -->
</body>

</html>
