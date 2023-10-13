@extends('layouts.interno')

@section('titulo')
    {{ $usuario->name }} - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>{{ $usuario->name }}</h1>
        <!-- Modal button -->
        <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#EditarUsuario">
            <i class="fas fa-pen-to-square"></i> Editar
        </button>

        <!-- Modal -->
        @include('usuarios.components.editar')
    </div>
    <div class="bg-white mx-3 my-2 p-4 rounded">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Nome:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $usuario->name }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>CPF:</strong></p>
                <p class="border-bottom border-secondary p-2">
                    {{ $usuario->locatario->cpf ? maskCPF($usuario->locatario->cpf) : 'Não informado' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Telefone:</strong></p>
                <p class="border-bottom border-secondary p-2">
                    {{ $usuario->locatario->telefone ? maskTelefone($usuario->locatario->telefone) : 'Não informado' }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Email:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $usuario->email }}</p>
            </div>
        </div>
    </div>

    <div class="box-historico bg-white mx-3 my-2 p-4 rounded h-50">
        <h1>Livros Emprestados</h1>
        @forelse($usuario->locatario->emprestimos as $emprestimo)
            <div class="emprestimos row border border-secondary rounded p-3 m-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $emprestimo->data_emprestimo }}</strong>
                    </div>
                    <div>
                        <a href="{{ route('emprestimos.detalhes', $emprestimo->id) }}"><i class="fas fa-circle-info"></i>
                            Detalhes</a>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div>
                        <p>{{ $emprestimo->livro->titulo }}</p>
                    </div>
                    <div>
                        @if ($emprestimo->data_devolucao == 'Não devolvido')
                            <p class="@if ($emprestimo->atrasado) text-danger @else text-secondary @endif">Data para
                                Devolução: {{ $emprestimo->data_devolucao_esperada }}</p>
                        @else
                            <p class="text-secondary">Data de Devolução: {{ $emprestimo->data_devolucao }}</p>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <p>Não há histórico de empréstimo para este usuário.</p>
        @endforelse
    </div>
@endsection

@section('script')
    <script>
        $('#EditarUsuario').on('shown.bs.modal', function(e) {
            //Mecanismo de visualização de senha
            function togglePassword(eye, input) {
                passwordInput = document.querySelector("#" + input);

                if (passwordInput.type == "password") {
                    passwordInput.type = "text"
                    eye.classList.remove("fa-eye")
                    eye.classList.add("fa-eye-slash")
                } else {
                    passwordInput.type = "password"
                    eye.classList.remove("fa-eye-slash")
                    eye.classList.add("fa-eye")
                }
            }

            eye = document.querySelector("#eye");
            eye_confirm = document.querySelector("#eye_confirm");

            eye.addEventListener("click", function() {
                togglePassword(this, "new_password");
            });
            eye_confirm.addEventListener("click", function() {
                togglePassword(this, "confirm_password");
            });
        });

        //Abrindo o modal de cadastro caso haja erro de validação
        @if (isset($msg) && $msg->tipo == 'danger')
            var myModal = new bootstrap.Modal(document.getElementById('editarUsuario'));
            myModal.show();
        @endif
    </script>
@endsection
