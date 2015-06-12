<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Dialect database</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="">Woorden</a></li>
                <li><a href="">Contact</a></li>
            </ul>

            @if(! Auth::check())
                <form method="POST" action="/login" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Wachtwoord" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                    <a class="btn btn-danger" href="">Reset Password</a>
                </form>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {!! Auth::user()->firstname !!} {!! Auth::user()->lastname !!}
                        </a>

                        <ul class="dropdown-menu">
                            <li> <a href="/logout"> @lang('auth.logout') </a> </li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>