<div class="modal fade" id="CriarLivro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="CriarLivro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Cadastro de Livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('livros.criar') }}" method="POST">
                    @csrf
                    <input type="text" required maxlength="255" class="form-control" placeholder="Título do livro"
                        name="titulo" value="{{ old('titulo') }}">
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" list="dl-autor" class="form-control"
                                placeholder="Nome do autor" name="autor" id="autor" autocomplete="off">
                            <datalist id="dl-autor">
                                @foreach ($autores as $autor)
                                    <option value="{{ $autor->nome }}"
                                        @if (old('autor') == $autor->nome) selected @endif></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" list="dl-genero" class="form-control"
                                placeholder="Gênero" name="genero" id="genero" autocomplete="off">
                            <datalist id="dl-genero">
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->nome }}"
                                        @if (old('genero') == $genero->nome) selected @endif></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" class="form-control" placeholder="Editora"
                                name="editora" value="{{ old('editora') }}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Edição" name="edicao"
                                value="{{ old('edicao') }}">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Volume" name="volume" value="{{old('volume')}}">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Nº de páginas"
                                name="paginas" value="{{old('paginas')}}">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="Quant. de Exemplates"
                                name="quant-exemplares" value="{{old('quant-exemplares')}}" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="ISBN" name="isbn" value="{{old('isbn')}}" required>
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
