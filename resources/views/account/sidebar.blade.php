
<li class="{{ $currentPage == 'dashboard' ? 'active' : '' }}"><a href="{{ route('account.dashboard') }}">Account Dashboard</a></li>
<li class="{{ $currentPage == 'accountinfo' ? 'active' : '' }}"><a href="{{route('account.info')}}">Account Information</a></li>
<li class="{{ $currentPage == 'logocover' ? 'active' : '' }}"><a href="{{route('account.logocover')}}">Logo & Cover Image</a></li>
<li><a href="/password/change">Change Password</a></li>
{{-- <li class="{{ $currentPage == 'addressbook' ? 'active' : '' }}"><a href="/account/addresses">Address Book</a></li> --}}
{{-- <li class="dropdown-divider"></li> --}}
<li class="{{ $currentPage == 'clientorders' ? 'active' : '' }}"><a href="{{route('account.orders.index')}}">Orders I Made</a></li>
{{-- <li class="{{ $currentPage == 'clientmessages' ? 'active' : '' }}"><a href="#">My Messages</a></li> --}}
<li><h5 style="margin: 0; margin-top: 20px; color: #c00">For Merchant</h5></li>
<li class="{{ $currentPage == 'merchantnewproduct' ? 'active' : '' }}"><a href="{{ route('account.product.create') }}">Add New Product</a></li>
<li class="{{ $currentPage == 'merchangeproducts' ? 'active' : '' }}"><a href="{{ route('account.product.index') }}">My Products</a></li>
<li class="{{ $currentPage == 'merchantorders' ? 'active' : '' }}"><a href="#">Incoming Orders</a></li>
<li class="{{ $currentPage == 'merchantmessages' ? 'active' : '' }}"><a href="#">My Messages <span class="badge badge-light">9</span></a></li>
