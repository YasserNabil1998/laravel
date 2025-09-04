<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل سؤال - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-edit"></i> تعديل سؤال #{{ $id }}</h2>
                <a href="{{ route('admin.questions.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> الرجوع</a>
            </div>
            <form method="POST" action="{{ route('admin.questions.update', $id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label class="form-label">الاختبار (اختياري)</label>
                    <select class="form-select" name="exam_id">
                        <option value="">بدون</option>
                        @php($exams = \App\Models\Exam::orderBy('title')->get(['id','title']))
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}" @selected(old('exam_id', $question->exam_id)==$exam->id)>{{ $exam->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">نص السؤال *</label>
                    <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">نوع السؤال *</label>
                    <select class="form-select" name="question_type" required>
                        <option value="multiple_choice" @selected(old('question_type', $question->question_type)=='multiple_choice')>اختيار من متعدد</option>
                        <option value="true_false" @selected(old('question_type', $question->question_type)=='true_false')>صح أو خطأ</option>
                        <option value="essay" @selected(old('question_type', $question->question_type)=='essay')>مقالي</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">الدرجة *</label>
                    <input type="number" name="points" class="form-control" value="{{ old('points', $question->points) }}" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">الترتيب</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $question->order) }}" min="0">
                </div>
                <div class="col-md-12">
                    <label class="form-label">الإجابة الصحيحة *</label>
                    <input type="text" name="correct_answer" class="form-control" value="{{ old('correct_answer', $question->correct_answer) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">الحالة</label>
                    <select class="form-select" name="is_active">
                        <option value="1" @selected(old('is_active', $question->is_active))>نشط</option>
                        <option value="0" @selected(!old('is_active', $question->is_active))>غير نشط</option>
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


