<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Header component --}}
        @include('components.header')
    </head>
    <body>
        {{-- Navbar component --}}
        @include('components.navbar')

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jumbotron">
                        <h1>Dialect database.</h1>
                        <p>
                            Een onderzoeks platform voor nederlandstalige dialecten.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- JavaScript component --}}
        @include('components.footer')
    </body>
</html>