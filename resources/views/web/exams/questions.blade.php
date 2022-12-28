@extends('web.layout')

@section('title')
Exam-{{$exam->name()}} Questions
@endsection


@section('styles')
<link href="{{asset('web/assets/css/TimeCircles.css')}}" rel="stylesheet">
@endsection

@section('main')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/blog-post-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="category.html">{{$exam->skill->cat->name()}}</a></li>
                        <li><a href="category.html">{{$exam->skill->name()}}</a></li>
                        <li>{{$exam->name()}}</li>
                    </ul>
                    <h1 class="white-text">Exam name</h1>
                    <ul class="blog-post-meta">
                        <li>18 Oct, 2017</li>
                        <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> 35</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-9">

                    <!-- blog post -->
                    <div class="blog-post mb-5">
                        <form id="exam-submit-form" action="{{url("exams/submit/{$exam->id}")}}" method="POST">
                            @csrf
                        </form>
                        <p>
                            @foreach ($exam->questions as $index => $ques )
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$index +1}}- {{$ques->title }}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answers[{{$ques->id}}]" value="1" form="exam-submit-form">
                                             {{$ques->option_1 }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answers[{{$ques->id}}]"  value="2" form="exam-submit-form">
                                             {{$ques->option_2 }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answers[{{$ques->id}}]"  value="3" form="exam-submit-form">
                                             {{$ques->option_3 }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answers[{{$ques->id}}]"  value="4" form="exam-submit-form">
                                            {{$ques->option_4 }}
                                        </label>
                                    </div>
                                </div>
                              </div>

                            @endforeach



                        </p>
                    </div>
                    <!-- /blog post -->

                    <div>
                        <button type="submit" form="exam-submit-form"  class="main-button icon-button pull-left">Submit</button>
                        <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
                    </div>
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                              <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">{{__('web.skill')}}: {{$exam->skill->name()}}</li>
                        <li class="list-group-item">{{__('web.questions')}}: {{$exam->questions_no}}</li>
                        <li class="list-group-item">{{__('web.duration')}}: {{$exam->duration_mins}} mins</li>
                        <li class="list-group-item">{{__('web.difficulty')}}:
                            @for($i = 1; $i < $exam->difficulty; $i++)
                                <i class="fa fa-star"></i>
                            @endfor

                            @for($i = 1; $i < $exam->difficulty -1 ; $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor

                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>

                        </li>
                    </ul>
                    <!-- /exam details widget -->

                    <!--timer-->
                    <div class="duration-countdown" data-timer="120"></div>
                    <!--timer-->

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->

@endsection


@section('scripts')
<script type="text/javascript" src="{{asset('web/assets/js/TimeCircles.js')}}"></script>
<script>
    $(".duration-countdown").TimeCircles({
          time: {
              Days: {
                   show: false
                }
            },
    count_past_zero:false,
    }).addListener(function(unit, value, total) {
        if(total <= 0) {
            $("#exam-submit-form").submit();
        };
});;
</script>


@endsection
