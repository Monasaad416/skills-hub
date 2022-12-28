@extends('web.layout')

@section('title')
All Exams
@endsection

@section('main')

    <!-- Blog -->
    <div id="blog" class="section">

                <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                @foreach($exams as $exam)
                   <!-- single exam -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="course">
                            <a href="#" class="course-img">
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
            </div>
            <!-- row -->
        <!-- pagination -->
        {{$exams->links('web.inc.paginator')}}
        <!-- pagination -->
        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
