<nav class="green lighten-1">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Soundeducation</a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
        