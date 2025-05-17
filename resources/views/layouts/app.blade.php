<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>INEC Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4 text-center">INEC Polling Unit Results - Delta State</h1>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a href="{{ route('result.polling-unit') }}" class="nav-link {{ request()->routeIs('result.polling-unit') ? 'active' : '' }}">
                    Polling Unit Result
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('lga.result.form') }}" class="nav-link {{ request()->routeIs('lga.result.form') || request()->routeIs('lga.result') ? 'active' : '' }}">
                    Summed LGA Result
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('result.create') }}" class="nav-link {{ request()->routeIs('result.create') || request()->routeIs('result.store') ? 'active' : '' }}">
                    Enter New Results
                </a>
            </li>
        </ul>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
