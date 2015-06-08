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
                    <div class="page-header">
                        <h3>Registeer</h3>
                    </div>

                    {{-- Registration form --}}
                    <form method="POST" action="/register">
                        <label for="01"> @lang('auth.registerFirstname'): </label>
                        <input id="01" type="text" name="firstname" placeholder="@lang('auth.registerFirstname')" class="register-form-width form-control">
                        <br />

                        <label for="02"> @lang('auth.registerLastname'): </label>
                        <input id="02" type="text" name="lastname" placeholder="@lang('auth.registerLastname')" class="register-form-width form-control">
                        <br />

                        <label for="03"> @lang('auth.registerEmail'): </label>
                        <input id="03" type="text" name="email" placeholder="@lang('auth.registerEmail')" class="form-control register-form-width">
                        <br />

                        <button class="btn btn-success" type="submit"> @lang('auth.buttonRegister') </button>
                        <button class="btn btn-danger" type="reset"> @lang('auth.buttonReset') </button>
                    </form>
                    {{-- End registration form --}}
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include ('components.footer')
    </body>
</html>