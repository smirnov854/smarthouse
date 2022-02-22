<?php
$user_data = $this->session->userdata();
echo $this->router->fetch_class();
?>

<nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand text-white">Служебный интерфейс УК</a>
    <div class="collapse-in navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="navbar-nav mr-auto">


                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Обращения<span class="caret"></span></a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="/warnings/show_list">Предупреждения</a></a>
                        <a class="dropdown-item" href="/services/show_list">Услуги</a>
                    </div>
                </li>

                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'flat_person' ? 'active' : ''?>" href="/flat_person/show_list">Жильцы</a></li>
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'flat' ? 'active' : ''?>" href="/flat/show_list">Квартиры</a></li>
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'flat_meter' ? 'active' : ''?>" href="/flat_meter/show_list">Датчики</a></li>
            <!--
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'warnings' ? 'active' : ''?>" href="/warnings/show_list">Предупреждения</a></li>
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'services' ? 'active' : ''?>" href="/services/show_list">Услуги</a></li>
            -->

                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'leak' ? 'active' : ''?>" href="/leak/show_list">Протечки</a> <i class="fa fa-bell text-white mr-5"><sup id="warning_container"></sup></i></li>
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'water_controller' ? 'active' : ''?>" href="/water_controller/show_list">Краны</a></li>
                <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'data' ? 'active' : ''?>" href="/data">Обмен с БД</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Администрирование<span class="caret"></span></a>
                <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="/user/show_users">Пользователи</a>
                    <a class="dropdown-item" href="/role/show_list">Роли</a>
                    <a class="dropdown-item" href="/rights/show_list">Права</a>
                    <!--
                            <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'user' ? 'active' : ''?>" href="/user/show_users">Пользователи</a></li>
                            <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'role' ? 'active' : ''?>" href="/role/show_list">Роли</a></li>
                            <li class="nav-item"><a class="nav-link <?=$this->router->fetch_class() == 'rights' ? 'active' : ''?>" href="/rights/show_list">Права</a></li>
                        -->

                </div>
            </li>
                <!--
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Статистика<span class="caret"></span></a>
                    <div class="dropdown-menu" role="menu"></div>
                </li>
                -->
                <!--<li class="nav-item"><a class="nav-link" href="#"></a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                    <div class="dropdown-menu" role="menu"></div>
                </li>-->
        </ul>
    </div>

    <span class="float-right text-white"><?=$user_data['name']."(".$user_data['role_name'].")"?></span>
    <a class="btn btn-danger float-right" href="/login/logout">x</a>
</nav>
   

