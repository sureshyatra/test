<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Admin') - Locations CMS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.location-pages.index') }}">Locations CMS</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.location-pages.index') }}">Overview</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.countries.index') }}">Countries</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.states.index') }}">States</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.cities.index') }}">Cities</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/admin-masters.js"></script>
</body>
</html>