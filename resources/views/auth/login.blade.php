@extends('web.layout')

@section('title')
Sign in
@endsection

@section('main')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="{{asset("web/assets/img/page-background.jpg")}}"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="{{url('/')}}">{{__('web.home')}}</a></li>
							<li>Sign In</li>
						</ul>
						<h2 class="white-text">Sign In to start exam</h2>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">
							<h4>Sign In</h4>
                            @include('web.inc.messages')
							<form method="POST" action="{{url('/login')}}">
                                @csrf
								<input class="input" type="email" name="email" placeholder="Email">
								<input class="input" type="password" name="password" placeholder="Password">
                                <input type="checkbox" name="remember">Remember Me
								<button type="submit" class="main-button icon-button pull-right">Sign In</button>
							</form>
                            <br>
                            <a href="{{url('forgot-password')}}">Forgot Password?</a>
						</div>
					</div>
					<!-- /login form -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection
