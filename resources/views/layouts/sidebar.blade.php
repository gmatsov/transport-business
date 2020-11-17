<nav>
<div class="bg-light" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">Codi Trans</div>
    <div class="list-group list-group-flush">
        <a href="{{route('home')}}" class="list-group-item list-group-item-action bg-light">
            <i class="fas fa-home"></i> Табло
        </a>
        <a href="{{route('truck.index')}}" class="list-group-item list-group-item-action bg-light">
                <i class="fas fa-truck-moving"></i> Камиони
        </a>
        <a href="{{route('reminder.index')}}" class="list-group-item list-group-item-action bg-light">
            <i class="fas fa-bell"></i> Напомняния
        </a>
        <a href="{{ route('report.index') }}" class="list-group-item list-group-item-action bg-light">
            <i class="fas fa-book-open"></i> Генерирай репорт
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
            <i class="fas fa-building"></i> Фирми</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
            <i class="fas fa-users"></i>
            Шофьори
        </a>
    </div>
</div>
</nav>
