<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charaset="UTF-8">
    <title>Family Book</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <script src="/js/app.js" defer></script>
</head>
<body>
    @include('navbar')
    
    <div class="container py-4">
        @yield('content')
    </div>
    
</body>
</html>