<nav class="navbar navbar-expand-sm navbar-white bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ route('livros.index') }}"><i class="fa-solid fa-book"></i></a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ session()->get('menuAtivo') == 'livros' ? 'active' : '' }}"
                        href="{{ route('livros.index') }}">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ session()->get('menuAtivo') == 'emprestimos' ? 'active' : '' }}"
                        href="{{ route('emprestimos.index') }}">Empréstimos</a>
                </li>
                @if (auth()->user()->admin)
                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('menuAtivo') == 'usuarios' ? 'active' : '' }}"
                            href="{{ route('usuarios.index') }}">Usuários</a>
                    </li>
                @endif
            </ul>
            <div class="end-menu">
                <ul>
                    @if (auth()->user()->locatario)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios.perfil', auth()->user()->id) }}">
                                <div class="user-info">
                                    <div class="user-credentials">
                                        <div class="username">
                                            {{ auth()->user()->name }}
                                        </div>
                                        <div class="email">
                                            {{ auth()->user()->email }}
                                        </div>
                                    </div>
                                    <div class="user-icon">
                                        {{ auth()->user()->name[0] }}
                                    </div>
                                </div>

                            </a>
                        </li>
                    @endif

                    <li class="nav-item btn-exit">
                        <a class="nav-link" href="{{ route('login.sair') }}"><i
                                class="fas fa-right-from-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
