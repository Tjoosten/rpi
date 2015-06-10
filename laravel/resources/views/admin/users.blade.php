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
                    <div role="tabpanel">

                        {{-- Nav tabs --}}
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#users" aria-controls="users" role="tab" data-toggle="tab"> @lang('auth.tabUsers') </a>
                            </li>
                        </ul>

                        {{-- Tab panes --}}
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="users">
                                <div class="padding-tab-content"></div>

                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table table-hover table-condensed">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> @lang('auth.tableUsersName'): </th>
                                                    <th> @lang('auth.tableUsersEmail'): </th>
                                                    <th </th> {{-- Functions --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($query as $output)
                                                    <tr>
                                                        <td><code> #{!! $output->id !!} </code></td>
                                                        <td>
                                                            {!! $output->firstname !!} {!! $output->lastname !!}
                                                        </td>
                                                        <td> {!! $output->email !!} </td>

                                                        {{-- Start toolbelt --}}
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="" class="btn btn-xs btn-danger">Block</a>
                                                                <a href="" class="btn btn-xs btn-danger">Admin</a>
                                                                <a href="" class="btn btn-xs btn-danger">Verwijder</a>
                                                            </div>
                                                        </td>
                                                        {{-- End toolbelt --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- Pagination --}}
                                {!! $query->render() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Footer component --}}
        @include('components.footer')
    </body>
</html>