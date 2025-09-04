<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل طالب - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-user-edit"></i> تعديل طالب #{{ $id }}</h2>
                <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> الرجوع</a>
            </div>
            <form class="row g-3" method="POST" action="{{ route('admin.students.update', $id) }}">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label class="form-label">البريد</label>
                    <input type="text" disabled class="form-control" value="{{ $student->user->email ?? '--' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">التخصص</label>
                    <input type="text" name="department" class="form-control" value="{{ old('department', $student->department) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">المستوى</label>
                    <input type="text" name="level" class="form-control" value="{{ old('level', $student->level) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">الفصل</label>
                    <input type="text" name="semester" class="form-control" value="{{ old('semester', $student->semester) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">تاريخ الالتحاق</label>
                    <input type="date" name="enrollment_date" class="form-control" value="{{ old('enrollment_date', optional($student->enrollment_date)->format('Y-m-d')) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">الحالة</label>
                    <select class="form-select" name="is_active">
                        <option value="1" @selected(old('is_active', $student->is_active))>نشط</option>
                        <option value="0" @selected(!old('is_active', $student->is_active))>غير نشط</option>
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-success">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


