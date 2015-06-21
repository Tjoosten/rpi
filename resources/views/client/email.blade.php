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
                <div class="col-sm-12 col-lg-12 col-md-12 col-lg-12">

                    <div class="page-header">
                        <h3> Contacteer ons </h3>
                    </div>

                    @if(count(count($errors->all()) > 0))
                        @foreach($errors->all() as $error)
                            {!! $error !!}
                        @endforeach
                    @endif

                    <form method="POST" action="/contact">

                        <label for="01"> Email adres: </label>
                        <input id="01" style="width: 25%" class="form-control" name="email" placeholder="Email adres" type="email" />
                        <br />

                        <label for="02"> Onderwerp: </label>
                        <input id="02" class="form-control" name="subject" style="width: 25%;" placeholder="Onderwerp" type="text" />
                        <br/>

                        <label for="03"> Bericht: </label>
                        <textarea id="03" class="form-control" placeholder="Uw bericht" style="height: 100px; width: 40%" name="message" type="text"></textarea>
                        <br>

                        <button type="submit" class="btn btn-success"> Versturen </button>

                    </form>
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>