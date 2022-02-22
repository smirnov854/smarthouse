<head>
    <link href="/resources/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/resources/vendor/bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="/resources/vendor/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/resources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="/resources/css/main.css" rel="stylesheet">

    <script src="/resources/vendor/jquery/jquery.min.js"></script>
    <script src="/resources/vendor/tether/tether.js"></script>
    <script src="/resources/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/resources/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
    <meta name="viewport" content="width=600px, initial-scale=0.6">
    <title>
    <?=$this->router->fetch_class() == 'user' ? 'Пользователи' : ''?>
    <?=$this->router->fetch_class() == 'role' ? 'Роли' : ''?>
    <?=$this->router->fetch_class() == 'rights' ? 'Права' : ''?>
    <?=$this->router->fetch_class() == 'flat_person' ? 'Жильцы' : ''?>
    <?=$this->router->fetch_class() == 'flat' ? 'Квартиры' : ''?>
    <?=$this->router->fetch_class() == 'flat_meter' ? 'Датчики' : ''?>
    <?=$this->router->fetch_class() == 'warnings' ? 'Предупреждения' : ''?>
    </title>
</head>
<body>
<div class="container-fluid">