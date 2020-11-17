<nav class="d-none d-md-block" id="sidebar">
    <div class="sidebar-header sidebar-logo">
        <a href="{{route('home')}}" class="btn d-block border-bottom">
            <img src="{{asset('img/logo.png')}}" alt="logo">
        </a>

    </div>
    <div class="sidebar-header">
        <h3 class="p-2"><i class="fas fa-home"></i> Начало</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a href="{{route('home')}}" class="btn d-block border-bottom">Табло</a>
        </li>

    </ul>
    <div class="sidebar-header">
        <h3 class="p-2"><i class="fas fa-truck-moving"></i> Камиони</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a href="{{route('truck.index')}}" class="btn d-block border-bottom">Моите камиони</a>
        </li>
        <li>
            <a href="{{route('truck.create')}}" class="btn  d-block border-bottom">Добави камион</a>
        </li>
    </ul>
    <div class="sidebar-header">
        <h3 class="p-2"><i class="fas fa-bell"></i> Напомняния</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a href="{{route('reminder.index')}}" class="btn d-block border-bottom">Напомняния</a>
        </li>
        <li>
            <a href="{{route('reminder.create')}}" class="btn  d-block border-bottom">Добави напомняне</a>
        </li>
    </ul>
    <div class="sidebar-header">
        <h3 class="p-2"><i class="fas fa-book-open"></i></i> Репорти</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a href="{{ route('report.index') }}" class="btn d-block border-bottom">Генерирай репорт</a>
        </li>
    </ul>
    <div class="sidebar-header">
        <h3 class="p-2"><i class="far fa-building"></i> Фирми</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a href="#" class="btn d-block border-bottom">Моите фирми</a>
        </li>
        <li>
            <a href="#" class="btn  d-block border-bottom">Добави фирма</a>
        </li>
    </ul>

</nav>
