<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--  Bootstrap4  --}}
    <link href="{{ asset('bootstrap-4/bootstrap.min.css') }}" rel="stylesheet" />
    <title>Admin Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Admin Login</h5>
                    </div>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <p class="bg-danger p-1 text-white">{{ session('error') }}</p>
                        @endif
                        <form action="{{ url('admin/login') }}" method="post">
                        {{ csrf_field() }}
                        <table class="table-bordered table">
                            <tr>
                                <th>Username</th>
                                <td>
                                    <input type="text" name="username" class="form-control">
                                    @if($errors->has('username'))
                                        @foreach($errors->get('username') as $msg)
                                        <p class="text-danger">{{ $msg }}</p>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <input type="password" name="pwd" class="form-control">
                                    @if($errors->has('pwd'))
                                    @foreach($errors->get('pwd') as $msg)
                                    <p class="text-danger">{{ $msg }}</p>
                                    @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Submit" class="btn btn-danger">
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>