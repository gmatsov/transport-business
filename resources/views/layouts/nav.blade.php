<nav class="navbar navbar-expand-md">
    <div class="container">
        @guest()
{{--            <span class="navbar-brand"></span>--}}
                {{--                {{ config('app.name', 'Transport Business') }}--}}
            </span>
        @else
        @endguest

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @guest()
            @else
                <ul class="navbar-nav mr-auto d-md-none">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Начало</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('truck.index')}}">Камиони</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('reminder.index')}}">Напомяния</a>
                    <li class="nav-item"><a class="nav-link" href="{{route('report.index')}}">Репорти</a>
                    </li>
                </ul>
        @endguest

        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name ? Auth::user()->first_name : Auth::user()->username }} <span
                                class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('user.edit', auth()->id())}}">Профил</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Изход') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
