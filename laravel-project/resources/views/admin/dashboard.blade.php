<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الإدمن - نفاذ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('styles.css') }}" rel="stylesheet">
    <style>
        .admin-layout { display: grid; grid-template-columns: 280px 1fr; min-height: 100vh; }
        .sidebar { background: #1e293b; color: #fff; padding: 20px; }
        .sidebar-header { text-align: center; margin-bottom: 30px; }
        .sidebar-header h3 { color: #20c997; font-weight: 700; }
        .nav-menu { list-style: none; padding: 0; margin: 0; }
        .nav-item { margin-bottom: 5px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: #cbd5e1; text-decoration: none; border-radius: 8px; transition: all 0.3s; }
        .nav-link:hover, .nav-link.active { background: #20c997; color: #fff; }
        .main-content { background: #f8fafc; padding: 30px; }
        .content-header { background: #fff; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 15px; }
        .stat-number { font-size: 32px; font-weight: 700; margin-bottom: 5px; }
        .stat-label { color: #6c757d; font-size: 14px; }
        .content-section { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .section-header { display: flex; justify-content: between; align-items: center; margin-bottom: 20px; }
        .btn-add { background: #20c997; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; }
        .table { margin-bottom: 0; }
        .table th { border-top: none; font-weight: 600; color: #495057; }
        .action-btn { padding: 6px 12px; border-radius: 6px; border: none; margin-right: 5px; font-size: 12px; }
        .btn-edit { background: #ffc107; color: #000; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-view { background: #17a2b8; color: #fff; }
        @media (max-width: 768px) { .admin-layout { grid-template-columns: 1fr; } .sidebar { display: none; } }
    </style>
</head>
<body>
    <div class="admin-layout">
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-shield-alt"></i> نفاذ</h3>
                <p>لوحة تحكم الإدمن</p>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#dashboard" class="nav-link active" data-section="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        لوحة التحكم
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/students') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        إدارة الطلاب
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/questions') }}" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        إدارة الأسئلة
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.exams.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        إدارة الاختبارات
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#reports" class="nav-link" data-section="reports">
                        <i class="fas fa-chart-bar"></i>
                        التقارير
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings" class="nav-link" data-section="settings">
                        <i class="fas fa-cog"></i>
                        الإعدادات
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a href="/" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div id="dashboard" class="content-section">
                <div class="content-header">
                    <h2><i class="fas fa-tachometer-alt"></i> لوحة التحكم</h2>
                    <p>مرحباً بك في لوحة تحكم نفاذ</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #e3f2fd; color: #1976d2;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ $metrics['totalStudents'] ?? 0 }}</div>
                        <div class="stat-label">إجمالي الطلاب</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #f3e5f5; color: #7b1fa2;">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="stat-number">{{ $metrics['availableQuestions'] ?? 0 }}</div>
                        <div class="stat-label">الأسئلة المتاحة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #e8f5e8; color: #388e3c;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-number">{{ $metrics['activeExams'] ?? 0 }}</div>
                        <div class="stat-label">الاختبارات النشطة</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #fff3e0; color: #f57c00;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-number">{{ $metrics['passRate'] ?? 0 }}%</div>
                        <div class="stat-label">معدل النجاح</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="content-section">
                            <h4>آخر الاختبارات المضافة</h4>
                            <div class="table-responsive">
                                <table class="table"><tbody>
                                    <tr><td>اختبار الرياضيات</td><td><span class="badge bg-success">نشط</span></td></tr>
                                    <tr><td>اختبار اللغة العربية</td><td><span class="badge bg-warning">قيد المراجعة</span></td></tr>
                                    <tr><td>اختبار العلوم</td><td><span class="badge bg-success">نشط</span></td></tr>
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-section">
                            <h4>آخر الطلاب المسجلين</h4>
                            <div class="table-responsive">
                                <table class="table"><tbody>
                                    <tr><td>أحمد محمد</td><td>2024-01-15</td></tr>
                                    <tr><td>فاطمة علي</td><td>2024-01-14</td></tr>
                                    <tr><td>محمد حسن</td><td>2024-01-13</td></tr>
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="exams" class="content-section" style="display: none;"></div>
            <div id="reports" class="content-section" style="display: none;"></div>
            <div id="settings" class="content-section" style="display: none;"></div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.nav-link[data-section]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.content-section').forEach(section => { section.style.display = 'none'; });
                const targetSection = this.getAttribute('data-section');
                if (targetSection) {
                    document.getElementById(targetSection).style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>


