@if (Sentry::check())
  <ul class="nav">
    <li class='active'><a href='#'>当前用户： {{Sentry::getuser()->last_name}}</a></li>
    
    <li class='active'><a href="{{ URL::route('logout') }}"><i class="icon-lock"></i> Logout</a></li>
  </ul>
@endif
