<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة طالب - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-user-plus"></i> إضافة طالب جديد</h2>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.students.index') }}"><i class="fas fa-arrow-right"></i> إلغاء</a>
                    <button class="btn btn-success" form="studentForm" type="submit"><i class="fas fa-save"></i> حفظ الطالب</button>
                </div>
            </div>
            <form id="studentForm" method="POST" action="{{ route('admin.students.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">رقم الطالب *</label>
                        <input type="text" name="student_id" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" name="is_active"><option value="1" selected>نشط</option><option value="0">غير نشط</option></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">البريد الإلكتروني *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">كلمة المرور *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">رقم الجوال</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">التخصص</label>
                        <input type="text" name="department" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">المستوى</label>
                        <input type="text" name="level" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الفصل</label>
                        <input type="text" name="semester" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">تاريخ الالتحاق</label>
                        <input type="date" name="enrollment_date" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


