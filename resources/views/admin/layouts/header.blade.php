<header style="height: 5%">
    <nav>
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse show-on-large"><i class="material-icons menu-icon">menu</i></a>
            <a href="admin/index">Soundeducation</a>
            <ul class="right hide-on-med-and-down">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Log uit
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>


    <ul id="slide-out" class="sidenav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('admin-lesson-index')}}">
                <i class="material-icons green-text lighten-1">music_note</i>
                Lessons
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin-teacher-index')}}">
                <i class="material-icons green-text lighten-1">people</i>
                Teachers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin-studio-index')}}">
                <i class="material-icons green-text lighten-1">business</i>
                Studios
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin-schoolgroup-index')}}">
                <i class="material-icons green-text lighten-1">school</i>
                Klassen
            </a>
        </li>
    </ul>
</header>