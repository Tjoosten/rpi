<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Header component --}}
        @include('components.header')

        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector:'textarea',
                menubar : false,
                height: 100,
                width:700
            });
        </script>
    </head>
    <body>
        {{-- Navbar component --}}
        @include('components.navbar')

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                    <div class="page-header">
                        <h3>Voeg een woord toe.</h3>
                    </div>

                    @if(count(count($errors->all()) > 0))
                        @foreach($errors->all() as $error)
                             {!! $error !!}
                        @endforeach
                    @endif

                    <form method="POST" action="/insertWord">
                        <label for="01">Woord (dialect):</label>
                        <input for="01" type="text" class="form-control field-insertWord" placeholder="Woord (dialect)" name="dialect">
                        <br/>

                        <label for="02">Woord (Nederlands):</label>
                        <input id="02" type="text" class="form-control field-insertWord" placeholder="Nederlands woord" name="wordAN">
                        <br/>

                        <label for="03"> Beschrijving: </label>
                        <textarea name="description" placeholder="Beschrijving"></textarea>
                        <br/>

                        <button type="submit" class="btn btn-success">Invoegen</button>
                        <button type="reset" class="btn btn-danger">Reset formulier</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>