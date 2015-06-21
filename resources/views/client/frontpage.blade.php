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

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <h2 class="text-center"> Vrijwilligers. </h2>

                        <p class="text-center">
                            Lorem ipsum Lorem Ipsum
                            <br /><br />

                            <a class="btn btn-default" href=""> Lees meer </a>
                        </p>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <h2 class="text-center"> Dialecten. </h2>

                        <p class="text-center">
                            Lorem ipsum Lorem Ipsum
                            <br /><br />

                            <a class="btn btn-default" href=""> Lees meer </a>
                        </p>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <h2 class="text-center"> API Ondersteund. </h2>

                        <p class="text-center">
                            Lorem ipsum Lorem Ipsum
                            <br /><br />

                            <a class="btn btn-default" href=""> Download Documentatie </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- JavaScript component --}}
        @include('components.footer')
    </body>
</html>