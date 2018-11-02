<header class="header">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                    <button class="mobile-menu-toggler" type="button">
                            <i class="icon-menu"></i>
                        </button>
                <a href="/" class="logo">
                    <img src="/assets/images/logo.png" alt="">
                </a>
            </div><!-- End .header-left -->



            <div class="header-right">
                
                <div class="header-contact">
                    <span>{{ auth()->user()->name }}</span>
                    <a href="tel:#"><strong>Admin Section</strong></a>
                </div><!-- End .header-contact -->

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
    <div class="header-bottom sticky-header">
        <div class="container">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="{{ $active == 'Dashboard' ? 'active' : '' }}"><a href="/adm">DASHBOARD</a></li>
                    <li class="{{ $active == 'Basic' ? 'active' : '' }}"><a href="#" class="sf-with-ul">Basic</a>
                        <ul>
                            <li><a href="{{ route('promo.index') }}">Top Messages</a></li>
                            <li><a href="{{ route('info.index') }}">Info Boxes</a></li>
                            <li>
                                <a href="#">Contents</a>
                                <ul>
                                    <li><a href="{{ route('contenttype.index') }}">Content Types</a></li>
                                    <li><a href="{{ route('content.index') }}">Content</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Banners</a>
                                <ul>
                                    <li><a href="{{ route('bannertype.index') }}">Banner Types</a></li>
                                    <li><a href="{{ route('banner.index') }}">Banners</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('outlet.index') }}">Outlets</a></li>
                        </ul>
                    </li>

                    <li class="{{ $active == 'Products' ? 'active' : '' }}"><a href="#" class="sf-with-ul">SHOP</a>
                        <ul>
                            <li><a href="{{ route('category.index') }}">Product Categories</a></li>
                            <li><a href="{{ route('paymentmethod.index') }}">Payment Methods</a></li>
                            <li><a href="{{ route('product.index') }}">Products</a></li>
                            <li><a href="{{ route('order.index') }}">Manage Orders</a></li>
                        </ul>
                    </li>
                    <li class="{{ $active == 'Lists' ? 'active' : '' }}"><a href="#" class="sf-with-ul">Lists</a>
                        <ul>
                            <li><a href="{{ route('newlist.index') }}">New Products</a></li>
                            <li><a href="{{ route('featuredlist.index') }}">Featured Products</a></li>
                        </ul>
                    </li>
                    <li class="{{ $active == 'Users' ? 'active' : '' }}"><a href="{{ route('userdetail.index') }}">Manage Users</a></li>
                    <li class="{{ $active == 'Settings' ? 'active' : '' }}"><a href="{{ route('setting.index') }}">Settings</a></li>
                    <li class="float-right">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            if (! confirm('Are You Sure?')) { return false; } 
                            else { document.getElementById('logout-form').submit(); }">
                            SIGN OUT
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li class="float-right"><a href="/">BACK TO SITE HOME</a></li>
                </ul>
            </nav>
        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
