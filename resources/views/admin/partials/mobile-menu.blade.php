<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="{{ $active == 'Dashboard' ? 'active' : '' }}"><a href="/adm">DASHBOARD</a></li>
                <li class="{{ $active == 'Basic' ? 'active' : '' }}"><a href="#" class="sf-with-ul">Basic</a>
                    <ul>
                        <li><a href="{{ route('promo.index') }}">Top Messages</a></li>
                        <li><a href="{{ route('info.index') }}">Info Boxes</a></li>
                        <li><a href="{{ route('content.index') }}">Contents</a></li>
                        <li><a href="{{ route('banner.index') }}">Banners</a></li>
                        <li><a href="{{ route('outlet.index') }}">Outlets</a></li>
                    </ul>
                </li>

                <li><a href="#" class="sf-with-ul">SHOP</a>
                    <ul>
                        <li><a href="{{ route('category.index') }}">Product Categories</a></li>
                        <li><a href="{{ route('paymentmethod.index') }}">Payment Methods</a></li>
                        <li><a href="{{ route('product.index') }}">Products</a></li>
                        <li><a href="{{ route('order.index') }}">Manage Orders</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sf-with-ul">Lists</a>
                    <ul>
                        <li><a href="{{ route('newlist.index') }}">New Products</a></li>
                        <li><a href="{{ route('featuredlist.index') }}">Featured Products</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('userdetail.index') }}">Manage Users</a></li>
                <li><a href="{{ route('setting.index') }}">Settings</a></li>
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
        </nav><!-- End .mobile-nav -->


    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->
