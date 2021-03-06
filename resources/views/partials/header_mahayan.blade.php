
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left header-dropdowns">

                &nbsp;&nbsp;&nbsp;
                <ul id="message_ticker" class="welcome-msg">
                    @foreach($promos as $promo)
                    <li><span class="badge badge-warning">Ad</span>&nbsp; <a href="{{$promo->link}}" class="text-promo">{{$promo->title}}</a></li>
                    @endforeach
                </ul>
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-dropdown dropdown-expanded">
                    <a href="#" style="font-weight: bold">Links</a>
                    <div class="header-menu">
                        <ul>
                            @guest
                            <li><a href="{{ route('login') }}" style="color: crimson">LOG IN</a></li>
                            <li><a href="{{ route('register') }}" style="color: crimson">SIGN UP</a></li>
                            @else
                            <li><a href="{{ route('account.dashboard') }}" style="color: crimson">MY ACCOUNT  ({{Auth::user()->name}})</a></li>
                            <li>
                                <a id="posted" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                    style="color: crimson">
                                    SIGN OUT
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endguest


                            <li><a href="/wishlist" style="color: crimson">MY WISHLIST </a></li>
                            <li><a href="/blog">BLOG</a></li>
                            <li><a href="/contact">Contact</a></li>

                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->
                <div class="header-dropdown" style="margin-left: 30px">
                    @php
                    $cur = session('currency') ?? 'NPR';
                    @endphp
                    <a href="#" style="color:crimson; font-weight: bold"><img src="{{ asset('assets/images/flags/'.$cur.'.jpg') }}">
                        {{$cur}}</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="/changecurrency/AUD"><img src="{{ asset('assets/images/flags/AUD.jpg') }}"> Australian
                                    Dollar (A$)</a></li>
                            <li><a href="/changecurrency/CAD"><img src="{{ asset('assets/images/flags/CAD.jpg') }}"> Canadian
                                    Dollar (C$)</a></li>
                            <li><a href="/changecurrency/CNY"><img src="{{ asset('assets/images/flags/CNY.jpg') }}"> Chinese Yuan
                                    (&#165;)</a></li>
                            <li><a href="/changecurrency/DKK"><img src="{{ asset('assets/images/flags/DKK.jpg') }}"> Danish Kroner
                                    (DKK)</a></li>
                            <li><a href="/changecurrency/EUR"><img src="{{ asset('assets/images/flags/EUR.jpg') }}"> European Euro
                                    (&#8364;)</a></li>
                            <li><a href="/changecurrency/HKD"><img src="{{ asset('assets/images/flags/HKD.jpg') }}"> Hong Kong
                                    Dollar (HK$)</a></li>
                            <li><a href="/changecurrency/INR"><img src="{{ asset('assets/images/flags/INR.jpg') }}"> Indian Rupees
                                    (&#8377;)</a></li>
                            <li><a href="/changecurrency/JPY"><img src="{{ asset('assets/images/flags/JPY.jpg') }}"> Japanese Yen
                                    (&#165;)</a></li>
                            <li><a href="/changecurrency/NPR"><img src="{{ asset('assets/images/flags/NPR.jpg') }}"> Nepalese
                                    Rupees (&#8360;)</a></li>
                            <li><a href="/changecurrency/SGD"><img src="{{ asset('assets/images/flags/SGD.jpg') }}"> Singapore
                                    Dollar (SG$)</a></li>
                            <li><a href="/changecurrency/KRW"><img src="{{ asset('assets/images/flags/KRW.jpg') }}"> South Korean
                                    Won (&#8361;)</a></li>
                            <li><a href="/changecurrency/SEK"><img src="{{ asset('assets/images/flags/SEK.jpg') }}"> Swedish
                                    Kroner (SEK)</a></li>
                            <li><a href="/changecurrency/CHF"><img src="{{ asset('assets/images/flags/CHF.jpg') }}"> Swiss Franc
                                    (CHF)</a></li>
                            <li><a href="/changecurrency/GBP"><img src="{{ asset('assets/images/flags/GBP.jpg') }}"> UK Pound
                                    Sterling (&#163;)</a></li>
                            <li><a href="/changecurrency/USD"><img src="{{ asset('assets/images/flags/USD.jpg') }}"> U.S. Dollar
                                    ($)</a></li>
                        </ul>


                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <a href="/" class="logo">
                    <img src="/assets/images/mahayan.png" alt="{{ $setting->site_name }}">
                </a>
                
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="all">All</option>
                                    @foreach($categories as $parent)
                                    <option value="{{$parent->id}}">{{$parent->category}}</option>
                                    @if($parent->children)
                                    @foreach($parent->children as $child)
                                    <option value="{{$child->id}}"> -- {{$child->category}}</option>
                                    @if($child->children)
                                    @foreach($child->children as $grandchild)
                                    <option value="{{$grandchild->id}}"> ---- {{$grandchild->category}}</option>
                                    @endforeach
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                            <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div><!-- End .headeer-center -->

            <div class="header-right">
                <div class="header-contact">
                    <span>Call us now</span>
                    <a href="tel:{{$setting->phone1}}"><strong>{{$setting->phone1}}</strong></a>
                </div><!-- End .header-contact -->

                <div class="dropdown cart-dropdown">
                    @include('partials.cart-menu')
                </div><!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="active"><a href="/">Home</a></li>
                    <li>
                        <a href="/categories" class="sf-with-ul">Categories</a>
                        <ul>
                            @foreach($categories as $parent)
                            <li>
                                <a href="/category/{{$parent->slug}}">{{$parent->category}}</a>
                                @if($parent->children->count() == 0) </li> @endif
                            @if($parent->children->count() > 0)
                            <ul>
                                @foreach($parent->children as $child)
                                <li>
                                    <a href="/catgory/{{$child->slug}}">{{$child->category}}</a>
                                    @if($child->children->count() == 0) </li> @endif
                                @if($child->children->count() > 0)
                                <ul>
                                    @foreach($child->children as $grandchild)
                                    <li>
                                        <a href="/catgory/{{$grandchild->slug}}">{{$grandchild->category}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                    </li>
                    @endforeach
                </ul>
                </li>
                @endif
                @endforeach
                </ul>
                </li>
                <li class="megamenu-container">
                    <a href="/products" class="sf-with-ul">Products</a>
                    <div class="megamenu">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="menu-title">
                                            <a href="/featured">Featured Products</a>
                                        </div>
                                        <ul>
                                            @foreach($featureds as $featured)
                                            <li><a href="/product/{{$featured->product['slug']}}">{{$featured->product['name']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div><!-- End .col-lg-4 -->
                                    <div class="col-lg-4">
                                        <div class="menu-title">
                                            <a href="/new">New Arrivals</a>
                                        </div>
                                        <ul>
                                            @foreach($newarrivals as $newarrival)
                                            <li><a href="/product/{{$newarrival->product['slug']}}">{{$newarrival->product['name']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div><!-- End .col-lg-4 -->
                                    <div class="col-lg-4">
                                        <div class="menu-title">
                                            <a href="/deals">Best Deals</a>
                                        </div>
                                        <ul>
                                            <li><a href="/deal/deal">Deal</a></li>
                                        </ul>
                                    </div><!-- End .col-lg-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .col-lg-8 -->
                            <div class="col-lg-4">
                                <div class="banner">
                                    <a href="#">
                                        <img class="product-promo" src="/assets/images/menu-banner.jpg" alt="Menu banner">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-lg-4 -->
                        </div>
                    </div><!-- End .megamenu -->
                </li>
                <li><a href="/account/dashboard">Track Order</a></li>
                
                <li><a href="/account/dashboard">Customer Care</a></li>
                
                <li><a href="/sales">Sales !</a></li>
                <li class="float-right">
                    @php
                        $outlet_id = session('outlet_id') ?? 0;
                        $outlet_name = session('outlet_name') ?? 'All Outlets';
                    @endphp
                    <a href="/outlets/{{$outlet_id}}" class="sf-with-ul">{{$outlet_name}}</a>
                    <ul>
                        @foreach($outlets as $outlet)
                        <li>
                            <a href="/changeoutlet/{{$outlet->id}}/{{$outlet->outlet}}">{{$outlet->outlet}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                </ul>

            </nav>
        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
