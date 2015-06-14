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
                    <form method="" action="">

                        <label for="01"> @lang('') </label>
                        <input id="01" name="email" placeholder="" type="email" />

                        <label for="02"> @lang('') </label>
                        <input id="02" name="subject" placeholder="" type="text" />
                        <br/>

                        <label for="03"> @lang('') </label>
                        <textarea id="03" name="message" type="text"></textarea>
                        <br>

                        <button type="submit" class="btn btn-danger"> @lang('') </button>

                    </form>
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>