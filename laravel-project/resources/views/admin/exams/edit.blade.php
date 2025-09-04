<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل اختبار - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-file-alt"></i> تعديل اختبار #{{ $id }}</h2>
                <a href="{{ route('admin.exams.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> الرجوع</a>
            </div>
            <form method="POST" action="{{ route('admin.exams.update', $id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label class="form-label">العنوان *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $exam->title) }}" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $exam->description) }}</textarea>
                </div>
                <div class="col-md-3">
                    <label class="form-label">المدة (دقائق) *</label>
                    <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $exam->duration_minutes) }}" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">عدد الأسئلة *</label>
                    <input type="number" name="total_questions" class="form-control" value="{{ old('total_questions', $exam->total_questions) }}" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">درجة النجاح *</label>
                    <input type="number" name="passing_score" class="form-control" value="{{ old('passing_score', $exam->passing_score) }}" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">الحالة</label>
                    <select name="is_active" class="form-select">
                        <option value="1" @selected(old('is_active', $exam->is_active))>نشط</option>
                        <option value="0" @selected(!old('is_active', $exam->is_active))>غير نشط</option>
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


