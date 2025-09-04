<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأسئلة - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-question-circle"></i> إدارة الأسئلة</h2>
                <div>
                    <a href="{{ url('/admin') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> لوحة التحكم</a>
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> إضافة سؤال</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>السؤال</th><th>النوع</th><th>الدرجة</th><th>الحالة</th><th style="width:160px">إجراءات</th></tr></thead>
                    <tbody>
                        @forelse($questions as $q)
                            <tr>
                                <td>{{ Str::limit($q->question_text, 80) }}</td>
                                <td>{{ $q->question_type }}</td>
                                <td>{{ $q->points }}</td>
                                <td>@if($q->is_active)<span class="badge bg-success">نشط</span>@else<span class="badge bg-secondary">غير نشط</span>@endif</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.questions.edit', $q->id) }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.questions.destroy', $q->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('تأكيد الحذف؟')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">لا توجد أسئلة بعد.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($questions, 'links'))
                <div class="mt-3">{{ $questions->links() }}</div>
            @endif
        </div>
    </div>
</body>
</html>


