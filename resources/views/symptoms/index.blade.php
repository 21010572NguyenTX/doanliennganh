<!DOCTYPE html>
<html>
<head>
    <title>Triệu Chứng</title>
</head>
<body>
    <h1>Triệu Chứng Khi Mắc Bệnh</h1>
    <ul>
        @foreach ($symptoms as $symptom)
            <li>{{ $symptom }}</li>
        @endforeach
    </ul>
</body>
</html>
