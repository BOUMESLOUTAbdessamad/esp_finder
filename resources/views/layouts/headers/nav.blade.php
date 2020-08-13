
<nav class="navbar navbar-light navbar-expand-md shadow navigation-clean-search" style="background-color: #eeeeee;filter: invert(0%);">
    <div class="container"><a class="navbar-brand" href="{{ url('/') }}">UResearch</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav">
            <li class="nav-item" role="presentation"><a class="nav-link active" href="{{ route('/') }}">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('/bachelor') }}">Bachelor</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('/master') }}">Master</a></li>
            </ul>
            <form class="form-inline" target="_self">
                <div class="form-group float-right d-xl-flex">
                    <label for="search-field"><i class="fa fa-search"></i></label>
                    <input style="border-bottom-width: 2px !important; border-bottom-style: solid !important; border-bottom-color: #DDD !important;" class="form-control search-field" type="search" id="search-field" name="search">
                </div>
            </form>
        </div>
    </div>
</nav>
