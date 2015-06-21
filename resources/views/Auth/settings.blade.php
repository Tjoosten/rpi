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
                <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">

                    <div class="page-header">
                        <h3> @lang('auth.settingsHeader') </h3>
                    </div>

                    <form method="POST" action="">

                        @foreach($query as $output)
                            <label for="01"> @lang('auth.settingsName') </label>
                            <input id="01" value="{{ $output->firstname }} {{ $output->lastname }}" class="form-with-recover form-control" type="text" disabled />
                            <br />

                            <label for="02"> @lang('auth.settingsEmail') </label>
                            <input id="02" value="{{ $output->email }}" class="form-control form-with-recover" name="email" type="email">
                            <br />
                        @endforeach

                        <button class="btn btn-success" type="submit"> @lang('auth.buttonSend') </button>
                        <button class="btn btn-danger" type="reset"> @lang('auth.buttonReset') </button>
                    </form>

                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>