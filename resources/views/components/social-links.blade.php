<div>
    <div class="col-md-4 col-md-push-8">
        <ul class="footer-social">
            @if($settings->facebook !== null)
            <li><a href="{{$settings->facebook}}" class="facebook"><i class="fa fa-facebook"></i></a></li>
            @endif

            @if($settings->twitter !== null)
            <li><a href="{{$settings->twitter}}" class="twitter"><i class="fa fa-twitter"></i></a></li>
            @endif

            @if($settings->instagram !== null)
            <li><a href="{{$settings->instagram}}" class="instagram"><i class="fa fa-instagram"></i></a></li>
            @endif

            @if($settings->youtube !== null)
            <li><a href="{{$settings->youtube}}" class="youtube"><i class="fa fa-youtube"></i></a></li>
            @endif

            @if($settings->linkedin !== null)
            <li><a href="{{$settings->linkedin}}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
            @endif
        </ul>
    </div>
</div>
