<!DOCTYPE html>
<html lang="en">
    <head>
        {{-- Header component --}}
        @include('components.header')
    </head>
    <body>
        {{-- Nvcabar component --}}
        @include('components.navbar')

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="page-header">
                        <h3> @lang('auth.resetEmail') </h3>
                    </div>

                    <form method="POST" action="/password/reset">
                        {{-- CSRF protection --}}
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <label for="01"> @lang('auth.registerEmail'): </label>
                        <input id="01" type="text" class="form-control form-with-recover" name="email" value="{!! old('email') !!}" placeholder="@lang('auth.registerEmail')">
                        <br />

                        <label for="02"> @lang('auth.resetPass'): </label>
                        <input id="02" type="password" class="form-control form-with-recover" name="password" placeholder="@lang('auth.resetPass')" />
                        <div style="margin-bottom: 7px;"></div>
                        <input id="02" type="password" class="form-control form-with-recover" placeholder="@lang('auth.resetPass')" name="password_confirmation">
                        <br />

                        <button class="btn btn-success" type="submit">
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