<link rel="stylesheet" href="{{URL::asset('css/css.css')}}">
  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Hockey webshop') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav" style="line-height:;">
                    <li style="margin-right:20px;"><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/categories">Categories</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/reviews">review</a></li>
                    <li><a href="{{route('product.shoppingCart')}}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>Shopping Cart
                        <span class="badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                        </a>
                    </li>
                      @if(Auth::check())
                            <li><a class="nav-link" href="{{route('user.profile')}}">User profile</a></li>
                          <li><a class="nav-link" href="{{route('user.logout')}}">log out</a></li>
                      @else
                        <li><a href="{{route('user.signup')}}">Signup</a></li>
                        <li><a href="{{route('user.signin')}}">Signin</a></li>
                      @endif
                    </ul>
                </div>
              </div>
