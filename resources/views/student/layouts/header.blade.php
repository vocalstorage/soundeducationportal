

<nav>
    <div class="nav-wrapper ">
        <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse show-on-large"><i class="material-icons menu-icon">menu</i></a>
        <a href="{{route('student-lesson-index')}}">Soundeducation</a>
        <ul class="right hide-on-med-and-down">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <ul class="collapsibleMenu collapsible menu">
            <li>
                <div class="collapsible-header waves-effect waves-light nav-item">
                    <a href="#" class="nav-link">
                        <i class="material-icons">account_circle</i>  <span class='icon-text'>Mijn account</span>
                    </a>
                </div>
                <div class="collapsible-body padding-none">
                    <ul class="collection">
                        <li class="collection-item waves-effect">
                            <a href="{{route('student-edit')}}">
                                <i class="material-icons green-text">edit</i>
                                <span class='icon-text'>Bewerken</span>
                            </a>
                        </li>
                        <li class="collection-item waves-effect">
                        <a href="{{route('student-appointments')}}">
                            <i class="material-icons green-text">event_note</i>
                            <span class='icon-text'>Afspraken</span>
                        </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header waves-effect waves-light nav-item">
                    <a class="nav-link" href="{{route('student-lesson-index')}}">
                        <i class="material-icons green-text lighten-1">music_note</i>
                        <span class='icon-text'>Lessen</span>
                    </a>
                </div>
            </li>
        </ul>
    </li>
</ul>