<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلاب - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2><i class="fas fa-users"></i> إدارة الطلاب</h2>
                <div>
                    <a href="{{ url('/admin') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-right"></i> لوحة التحكم</a>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> إضافة طالب</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>الاسم</th><th>البريد</th><th>الحالة</th><th style="width:160px">إجراءات</th></tr></thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->user->name ?? '-' }}</td>
                                <td>{{ $student->user->email ?? '-' }}</td>
                                <td>
                                    @if($student->is_active)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-secondary">غير نشط</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.edit', $student->id) }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('تأكيد الحذف؟')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">لا يوجد طلاب بعد.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($students, 'links'))
                <div class="mt-3">{{ $students->links() }}</div>
            @endif
        </div>
    </div>
</body>
</html>


