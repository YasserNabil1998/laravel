<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الاختبارات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-file-alt"></i> إدارة الاختبارات</h2>
                <a href="{{ url('/admin') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> لوحة التحكم</a>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.exams.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> إنشاء اختبار</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>العنوان</th><th>المدة</th><th>الأسئلة</th><th>الحالة</th><th style="width:160px">إجراءات</th></tr></thead>
                    <tbody>
                        @forelse($exams as $exam)
                            <tr>
                                <td>{{ $exam->title }}</td>
                                <td>{{ $exam->duration_minutes }} دقيقة</td>
                                <td>{{ $exam->total_questions }}</td>
                                <td>@if($exam->is_active)<span class="badge bg-success">نشط</span>@else<span class="badge bg-secondary">غير نشط</span>@endif</td>
                                <td>
                                    <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('تأكيد الحذف؟')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">لا توجد اختبارات.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($exams, 'links'))
                <div class="mt-3">{{ $exams->links() }}</div>
            @endif
        </div>
    </div>
</body>
</html>


