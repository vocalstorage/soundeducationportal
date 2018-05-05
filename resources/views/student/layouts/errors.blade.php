
@if ($errors->any())
    <div class="errors">
        <div class="row">
            <div class="col s12 m5">
                <div class="card-panel red lighten-1">
                    <span class="white-text">
                        @foreach ($errors->all() as $error)
                                  {{ $error }} <br>
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif