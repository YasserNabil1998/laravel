<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الطالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="login-section mx-auto" style="max-width:500px;">
            <h2 class="page-title">تسجيل دخول الطالب</h2>
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ url('/student/login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">كلمة المرور</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn-login">تسجيل الدخول</button>
            </form>
        </div>
    </div>
</body>
</html>


