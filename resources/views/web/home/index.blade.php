@extends('web.layout')

@section('title')
Homepage
@endsection


@section('main')
    <!-- Home -->
    <div id="home" class="hero-area">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/assets/img/home-background.jpg')}})"></div>
        <!-- /Backgound Image -->

        <div class="home-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="white-text">{{__('web.heroTitle')}}</h2>
                        <p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant, eu pro alii error homero.</p>
                        <a class="main-button icon-button" href="#">{{__('web.getStartedBtn')}}!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Home -->

    <!-- exams -->
    <div id="courses" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>{{__('web.popularExamTitle')}}</h2>
                    <p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
                </div>
            </div>
            <!-- /row -->

            <!-- courses -->
            <div id="courses-wrapper">

                <!-- row -->
                <div class="row">
                    @foreach($exams as $exam)
                    <!-- single exam -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="{{url("/exams/show/$exam->id")}}" class="course-img">
                                    <img src="{{asset('uploads/' . $exam->img)}}" alt="">
                                    <i class="course-link-icon fa fa-link"></i>
                                </a>
                                <a class="course-title" href="#">
                                 {{Str::of($exam->desc())->words(10 , '...')}}
                                </a>
                                <div class="course-details">
                                    <span class="course-category">{{$exam->skill->name()}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- /single exam -->
                </div>
                <!-- /row -->


            </div>
            <!-- /courses -->

            <div class="row">
                <div class="center-btn">
                    <a class="main-button icon-button" href="{{url('/exams')}}">{{__('web.moreExams')}}</a>
                </div>
            </div>

        </div>
        <!-- container -->

    </div>
    <!-- /exams -->



    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/assets/img/cta.jpg')}}"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">Contact Us</h2>
                    <p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
                    <a class="main-button icon-button" href="{{url('/contact')}}">Contact Us Now</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->
@endsection
