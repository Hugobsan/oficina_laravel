<div class="modal fade" id="EditarLivro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="EditarLivro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edição de Livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('livros.atualizar', $livro->id) }}" method="POST">
                    @csrf
                    <input type="text" required maxlength="255" class="form-control" placeholder="Título do livro"
                        name="titulo" value="{{$livro->titulo}}">
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" list="dl-autor" class="form-control" 
                                placeholder="Nome do autor" name="autor" id="autor" autocomplete="off" value="{{$livro->autor->nome}}">
                            <datalist id="dl-autor">
                                @foreach ($autores as $autor)
                                    <option value="{{ $autor->nome }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" list="dl-genero" class="form-control"
                                placeholder="Gênero" name="genero" id="genero" autocomplete="off" value="{{$livro->genero->nome}}">
                            <datalist id="dl-genero">
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->nome }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" required maxlength="255" class="form-control" placeholder="Editora"
                                name="editora" value={{$livro->editora}}>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Edição" name="edicao" value={{$livro->edicao}}>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Volume" name="volume" value={{$livro->volume}}>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" required class="form-control" placeholder="Nº de páginas" name="paginas" value={{$livro->numero_paginas}}>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="Quant. de Exemplates"
                                name="quant-exemplares" value={{$livro->quantidade}} required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control" placeholder="ISBN" name="isbn" value={{$livro->isbn}} required>
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
