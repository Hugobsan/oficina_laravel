<div class="modal fade" id="EditarUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="EditarUsuario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edição de Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.atualizar', $usuario->id) }}" method="POST">
                    @csrf
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-12">
                            <input type="text" required maxlength="255" class="form-control"
                                placeholder="Nome do Usuário" name="name" value="{{ $usuario->name }}">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-12">
                            <input type="email" required maxlength="255" class="form-control" placeholder="E-mail"
                                name="email" value="{{ $usuario->email }}">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF"
                                value="{{ $usuario->locatario->cpf }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" name="telefone" id="telefone" class="form-control"
                                placeholder="Telefone" value="{{ $usuario->locatario->telefone }}">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="password-container col-sm-12 col-md-4">
                            <input type="password" class="form-control" placeholder="Senha antiga" name="old_password"
                                id="old_password">
                        </div>
                        <div class="password-container col-sm-12 col-md-4">
                            <input type="password" class="form-control" placeholder="Nova Senha" name="new_password"
                                id="new_password">
                            <i class="fa-solid fa-eye" id="eye"></i>
                        </div>
                        <div class="password-container col-sm-12 col-md-4">
                            <input type="password" class="form-control" placeholder="Confirmar Nova Senha"
                                name="new_password_confirmation" id="confirm_password">
                            <i class="fa-solid fa-eye" id="eye_confirm"></i>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
            </form>
        </div>
    </div>
</div>
