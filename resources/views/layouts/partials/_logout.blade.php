<a href="{{ route($routeName) }}"
   onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">Log Out</a>
<form id="logout-form" action="{{ route($routeName) }}" method="POST" style="display: none;">
    @csrf
</form>