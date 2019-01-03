<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
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
                <li>
                    <a href="/products" class="sf-with-ul">Products</a>
                </li>
                <li>
                    <a href="/outlets" class="sf-with-ul">Outlets</a>
                    <ul>
                        @foreach($outlets as $outlet)
                        <li>
                            <a href="/outlet/{{$outlet->slug}}">{{$outlet->outlet}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/account/dashboard">Track Order</a></li>

                <li><a href="/account/dashboard">Customer Care</a></li>

                <li class="float-right"><a href="/daily-deals">Daily Deals</a></li>
                <li class="float-right"><a href="/sales">Sales !</a></li>
                </ul>
            </nav><!-- End .mobile-nav -->
            <div class="mb-5"></div>
            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->