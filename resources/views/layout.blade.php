<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('trucks.index') }}" class="btn btn-sm btn-primary">Trucks</a>
        </div>
    </div>

    <div class="container mt-5">
        @yield('content')
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
</body>

</html>