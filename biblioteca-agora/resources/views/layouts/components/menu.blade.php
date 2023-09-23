<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('livros.index') }}"><i class="fa-solid fa-book"></i></a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('livros.index') }}">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('emprestimos.index') }}">Empréstimos</a>
                </li>
                @if (auth()->user()->admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.index') }}">Usuários</a>
                    </li>
                @endif
                <span>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuarios.perfil', auth()->user()->id) }}">
                            <span>
                                <span>
                                    {{ auth()->user()->name }}
                                </span>
                                <span>
                                    {{ auth()->user()->email }}
                                </span>
                            </span>
                            <span class="border-secondary rounded-circle">
                                {{ strstr(auth()->user()->name, ' ', true)[0]}}
                            </span>
                        </a>
                        <i class="fas fa-user"></i>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.sair') }}"><i
                                class="fas fa-right-from-bracket"></i></a>
                    </li>
                </span>

            </ul>
        </div>
    </div>
</nav>
