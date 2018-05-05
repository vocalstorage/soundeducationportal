<nav class="green lighten-1">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Soundeducation</a>
        <ul id="nav" class="right">
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
        