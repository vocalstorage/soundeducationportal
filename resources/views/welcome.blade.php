@extends('student.layouts.master')
<div class="welcome_wrapper">
    <div class="row">
        <div class="col s12">
            <nav>
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo center">Logo</a>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
            </nav>



        </div>

    </div>
</div>
