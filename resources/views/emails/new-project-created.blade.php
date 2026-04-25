<!DOCTYPE html>
<html>
<head>
    <title>New Project Created</title>
</head>
<body>
    <h1>مرحباً!</h1>
    <p>تم إنشاء مشروع جديد على منصة HireHub:</p>
    <ul>
        <li><strong>عنوان المشروع:</strong> {{ $project->title }}</li>
        <li><strong>الميزانية:</strong>{{ $project->budget }}
            {{ $project->type_of_balance === 'fixed' ? 'USD (مبلغ ثابت)' : 'USD/ساعة' }}
        </li>
        <li><strong>تاريخ التسليم:</strong> {{ $project->deadline->format('d/m/Y') }}</li>
    </ul>
    <p>
        <a href="{{ url('/api/V1/projects/' . $project->id) }}">عرض تفاصيل المشروع</a>
    </p>
    <p>تحيات فريق HireHub</p>
</body>
</html>
