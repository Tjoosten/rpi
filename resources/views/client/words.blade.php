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

            {{-- Search box --}}
            <div class="row">
                <div class="col-md-8 col-sm-8 col-lg-8 col-xs-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-offset-2">
                    <span class="text-center">
                        <form method="GET" action="/search" class="form-inline">
                            <input type="text"
                                   style="width: 87.4%;"
                                   name="searchterm"
                                   placeholder="Zoek een woord"
                                   class="form-control"
                                            />

                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-search"></span>
                                Zoeken
                            </button>
                        </form>
                    </span
                </div>
            </div>

            {{-- Results --}}
            <div class="row">
                <div class="col-md-8 col-sm-8 col-lg-8 col-xs-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-offset-2">
                    <div style="margin-top: 20px;"></div>
                    @if(count($query) === 0)
                        <div class="alert alert-warning">
                            <h4>Geen resultaten</h4>
                            <p>Er zijn helaas nog geen woorden te vinden in onze database.</p>
                        </div>
                    @elseif(count($query) > 0)
                        @foreach($query as $output)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {!! $output->dialect !!}
                                    <i class="text-muted"> ({!! $output->word_an !!}) </i>

                                    {{-- Logged In & Admin functions --}}
                                    @if(Auth::check())
                                        @if(Auth::user()->role == 'A')
                                            <span class="pull-right">
                                                <a href="" class="label label-warning">Wijzig</a>
                                                <a href="" class="label label-danger">Verwijder</a>
                                            </span>
                                        @endif
                                    @endif
                                </div>

                                <div class="panel-body">
                                    {!! $output->description !!}
                                </div>
                            </div>
                        @endforeach

                            <div style="margin-top: -22px; margin-bottom: 7px;" class="text-center">
                                {!! $query->render() !!}
                            </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>