@if (Sentry::check())
  <ul class="nav">
    <li class='active'><a href="{{ URL::route('register') }}"><i class="icon-book"></i> Register</a></li>
    <li class="{{ Request::is('admin/articles*') ? 'active' : null }}"><a href="{{ URL::route('admin.articles.index') }}"><i class="icon-edit"></i> Articles</a></li>
    <li><a href="{{ URL::route('logout') }}"><i class="icon-lock"></i> Logout</a></li>
  </ul>
@endif
