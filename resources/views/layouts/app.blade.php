<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Приложение')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Ваши дополнительные стили -->
</head>
<body>
<div class="container mt-5">
    @yield('content')
</div>

<!-- Скрипты -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<!-- Ваши дополнительные скрипты -->
</body>
</html>
