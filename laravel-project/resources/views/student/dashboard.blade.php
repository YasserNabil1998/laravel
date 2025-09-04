<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الطالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-user"></i> مرحباً بك</h2>
                <form method="POST" action="{{ url('/student/logout') }}">@csrf <button class="btn btn-outline-danger">تسجيل الخروج</button></form>
            </div>
            <div class="alert alert-info">هذه لوحة الطالب. سنربط الاختبارات لاحقاً.</div>
        </div>
    </div>
</body>
</html>


