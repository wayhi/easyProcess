@if (Sentry::check())
  <ul class="nav">
    <li class='active'><a href="{{ URL::route('register') }}"><i class="icon-book"></i> Register</a></li>
    <li class='active'><a href="{{ URL::route('admin.approval.create') }}"><i class="icon-edit"></i> Approval Setting</a></li>
    <li><a href="{{ URL::route('logout') }}"><i class="icon-lock"></i> Logout</a></li>
  </ul>
@endif
