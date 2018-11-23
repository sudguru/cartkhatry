
<li class="{{ $currentPage == 'dashboard' ? 'active' : '' }}"><a href="{{ route('account.dashboard') }}">Account Dashboard</a></li>
<li class="{{ $currentPage == 'accountinfo' ? 'active' : '' }}"><a href="{{route('account.info')}}">Account Information</a></li>
<li><a href="/auth/password/change">Change Password</a></li>
<li class="{{ $currentPage == 'addressbook' ? 'active' : '' }}"><a href="/account/addresses">Address Book</a></li>
<li class="dropdown-divider"></li>
<li class="{{ $currentPage == 'clientorders' ? 'active' : '' }}"><a href="/account/customer/orders">My Orders</a></li>
<li class="{{ $currentPage == 'clientmessages' ? 'active' : '' }}"><a href="#">My Messages</a></li>
