<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة سؤال - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-question-circle"></i> إضافة سؤال جديد</h2>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('admin.questions.index') }}"><i class="fas fa-arrow-right"></i> إلغاء</a>
                    <button class="btn btn-success" form="questionForm" type="submit"><i class="fas fa-save"></i> حفظ السؤال</button>
                </div>
            </div>
            <form id="questionForm" method="POST" action="{{ route('admin.questions.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">الاختبار (اختياري)</label>
                        <select class="form-select" name="exam_id">
                            <option value="">بدون</option>
                            @php($exams = \App\Models\Exam::orderBy('title')->get(['id','title']))
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">نص السؤال *</label>
                        <textarea name="question_text" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">نوع السؤال *</label>
                        <select class="form-select" name="question_type" required>
                            <option value="multiple_choice">اختيار من متعدد</option>
                            <option value="true_false">صح أو خطأ</option>
                            <option value="essay">مقالي</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الدرجة *</label>
                        <input type="number" name="points" class="form-control" value="1" min="1" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الترتيب</label>
                        <input type="number" name="order" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">الإجابة الصحيحة *</label>
                        <input type="text" name="correct_answer" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" name="is_active">
                            <option value="1" selected>نشط</option>
                            <option value="0">غير نشط</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


