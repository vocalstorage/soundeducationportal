<header style="height: 5%">
    <nav>
        <div class="nav-wrapper ">
            <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse show-on-large"><i
                        class="material-icons white-text">menu</i></a>
            <a href="{{route('teacher-lesson-index')}}">Soundeducation</a>
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
            <a class="nav-link active" href="{{route('teacher-edit')}}">
                <i class="material-icons green-text lighten-1">account_circle</i>
                <span class="icon-text">{{trans('form.label.myAccount')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('teacher-lesson-index')}}">
                <i class="material-icons green-text lighten-1">music_note</i>
                <span class="icon-text">{{trans('modules/lesson.title')}}</span>
            </a>
        </li>
    </ul>
</header>