<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Assignment OAuth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    @php
        $currentUser = Auth::user();
        $sessionUser = session('oauth_user');
        $provider = $currentUser->provider ?? session('oauth_provider');
    @endphp

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body text-center">
                <h2 class="mb-4">Đăng nhập thành công!</h2>
                @if($provider !== 'facebook' && ($currentUser || $sessionUser))
                    <img
                        src="{{ $currentUser->avatar ?? $sessionUser['avatar'] ?? 'https://via.placeholder.com/100' }}"
                        class="rounded-circle mb-3"
                        style="width: 100px; height: 100px; object-fit: cover;"
                    >
                    <h4>Chào mừng, {{ $currentUser->name ?? $sessionUser['name'] ?? 'Người dùng' }}!</h4>
                    <h5>MSV {{ $currentUser->student_id ?? $sessionUser['student_id'] ?? '23810310263' }}</h5>
                    <p class="text-muted">{{ $currentUser->email ?? $sessionUser['email'] ?? '' }}</p>
                @endif
                <hr>
                <a href="/logout" class="btn btn-danger">Đăng xuất</a>
            </div>
        </div>
    </div>
</body>
</html>
