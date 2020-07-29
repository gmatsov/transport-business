<nav class="d-none d-md-block" id="sidebar">
    <div class="sidebar-header">
        <h3 class="text-center p-2"><i class="fas fa-truck-moving"></i> Камиони</h3>
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
        <h3 class="text-center p-2"><i class="fas fa-bell"></i> Напомняния</h3>
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
        <h3 class="text-center p-2"><i class="far fa-building"></i> Фирми</h3>
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
