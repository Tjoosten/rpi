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
                <li class="dropdown"">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Woorden
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="/words">Woorden</a></li>
                        <li><a href="/insertWord">Woord toevoegen</a></li>
                    </ul>
                </li>

                <li><a href="/contact">Contact</a></li>
            </ul>

            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {!! Auth::user()->firstname !!} {!! Auth::user()->lastname !!}
                        </a>

                        <ul class="dropdown-menu">

                            <li> <a href="/logout"> @lang('auth.logout') </a> </li>
                        </ul>
                    </li>
                </ul>
            @else
                <form method="POST" action="/login" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Wachtwoord" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                    <a class="btn btn-danger" href="">Reset Password</a>
                </form>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>