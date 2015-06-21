<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="laravel/public/css/costum.css"/>
        {{-- Header component --}}
        @include('components.header')
    </head>
    <body>
        {{-- Navbar component --}}
        @include('components.navbar')

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                    <div class="page-header">
                        <h3> @lang('auth.recoverPassword') </h3>
                    </div>

                    <form method="POST" action="/password/email">
                        {{-- CSRF Field --}}
                        {!! csrf_field() !!}

                        <label for="01"> @lang('auth.registerEmail'): </label>
                        <input type="email" class="form-with-recover form-control" id="01" name="email" value="{!! old('email') !!}" placeholder="@lang('auth.registerEmail')">
                        <br>

                        <button class="btn btn-danger" type="submit">
                            @lang('auth.buttonSend')
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>