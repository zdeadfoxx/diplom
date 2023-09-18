@if(Auth::user())
<header class="bg-light mb-3">
    <div class="container d-flex justify-content-center header__body">
        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ">
                    <li class="nav-item">
                    <a class=" link" href="{{ Route('text.index') }}">Текст</a>
                    </li>
                    <li class="nav-item">
                    <a class=" link" aria-current="page" href="{{ Route('file.index') }}">Файлы</a>
                    </li>
              </ul>
              <ul class="loguot__user">
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->email }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </li>
            </ul>
            </div>
          </nav>
    </div>

</header>
@endif


