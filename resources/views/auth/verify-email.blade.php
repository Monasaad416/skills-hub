@extends('web.layout')

@section('title')
Verify Email
@endsection
@section('main')
<div class="alert alert-success">
    A verification email has been sent suiccessfully ,please check your inbox
</div>


<!-- row -->
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="contact-form">
        <form action="{{url('email/verification-notification')}}" method="POST">
            @csrf
            <button type="submit" class=" main-button icon-button pull-right">Resend Email</button>
        </form>
        </div>
    </div>
</div>
<!-- /row -->

@endsection
