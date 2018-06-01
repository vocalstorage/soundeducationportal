<header style="height: 5%">

    <nav>
        <div class="nav-wrapper green lighten-1">
            <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse show-on-large"><i
                        class="material-icons">menu</i></a>
            <a href="admin/index">Soundeducation</a>
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


    <ul id="slide-out" class="sidenav">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('teacher-lesson-index')}}">
                <i class="fas fa-book"></i>
                Lessons <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('teacher-edit')}}" class="collection-item waves-effect waves-light"><i
                        class="material-icons">edit</i>Edit account</a>
        </li>
    </ul>
</header>