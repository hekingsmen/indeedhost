<div class="classynav">
    <ul id="nav">



        <li @if(\Request::route()->getName()=='home') class="active" @endif><a href="{{ route('home') }}">Home</a></li>
        <li @if(\Request::route()->getName()=='hosting') class="active" @endif ><a href="{{ route('hosting') }}">Hosting</a></li>
        <li><a href="#">Pages</a>
            <ul class="dropdown">
                <li><a href="{{ route('home') }}">- Home</a></li>
                <li><a href="{{ route('hosting') }}">- Hosting</a></li>
                <li><a href="{{ route('about') }}">- About</a></li>
            </ul>
        </li>
        <li @if(\Request::route()->getName()=='about') class="active" @endif ><a href="{{ route('about') }}">About</a></li>
        <li><a href="javascript:void(0)">Blog</a></li>
        <li><a href="{{ route('contact.us') }}">Contact</a></li>
    </ul>

    <div class="live-chat-btn ml-5 mt-4 mt-lg-0 ml-md-4">

        <a href="{{route('cart')}}" data-toggle = "tooltip" title = "View Cart Item" class="btn hami-btn live--chat--btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="">{{\Cart::count()}}</span></a>

    </div>
</div>