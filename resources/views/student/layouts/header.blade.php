

<nav>
    <div class="nav-wrapper green lighten-1">
        <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse show-on-large"><i class="material-icons menu-icon">menu</i></a>
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
    <li>
        <ul class="collapsibleMenu collapsible menu">
            <li>
                <div class="collapsible-header waves-effect waves-light"><i
                            class="material-icons">account_circle</i>Mijn account
                </div>
                <div class="collapsible-body padding-none">
                    <div class="collection">

                        <a href="{{route('student-edit')}}" class="collection-item waves-effect waves-light"><i
                                    class="material-icons">edit</i>Bewerken</a>
                        <a href="{{route('student-appointments')}}" class="collection-item waves-effect waves-light"><i class="material-icons">event_note</i>Afspraken</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect waves-light"><a href="{{route('lesson-index')}}"><i class="material-icons">book</i>Les planner</a>
                </div>
            </li>
        </ul>
    </li>
</ul>