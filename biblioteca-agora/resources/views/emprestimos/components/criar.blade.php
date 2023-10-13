<div class="modal fade" id="CriarEmprestimo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="CriarEmprestimo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Empréstimo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('emprestimos.criar') }}" method="POST">
                    @csrf
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-12">
                            <label for="livro_id">Livro:</label>
                            <select class="form-select" name="livro_id" id="livro_id" required>
                                <option value="" selected disabled>Selecione um livro</option>
                                @foreach ($livros as $livro)
                                    <option value="{{ $livro->id }}"
                                        @if ($livro->id == old('livro_id')) selected @endif>{{ $livro->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-12">
                            <label for="locatario_id">Locatário:</label>
                            <select class="form-select" name="locatario_id" id="locatario_id" required>
                                <option value="" selected disabled>Selecione um locatário</option>
                                @foreach ($locatarios as $locatario)
                                    <option value="{{ $locatario->id }}"
                                        @if ($locatario->id == old('locatario_id')) selected @endif>{{ $locatario->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <label for="data_emprestimo">Data de Empréstimo:</label>
                            <input type="date" required class="form-control" placeholder="Data de Empréstimo"
                                name="data_emprestimo" id="data_emprestimo"
                                value="{{ old('data_emprestimo') ? old('data_emprestimo') : date('Y-m-d') }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="devolucao">Dias para Devolução:</label>
                            <input type="number" required class="form-control" placeholder="Dias para devolução"
                                name="devolucao" id="devolucao" value="{{ old('devolucao') }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
