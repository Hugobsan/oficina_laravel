@extends('layouts.interno')

@section('titulo')
    Livros - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>Livros</h1>
        @if (auth()->user()->admin)
            <!-- Modal button -->
            <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#CriarLivro">
                <i class="fas fa-plus"></i> Novo Livro
            </button>

            <!-- Modal -->
            @include('livros.components.criar')
        @endif
    </div>
    <div class="tabela table-responsive">
        <div>
            <form action="{{ route('livros.pesquisar') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="form-control" name="pesquisa"
                            placeholder="Pesquise por título, autor, editora ou gênero">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($livros as $livro)
                    <tr>
                        <td scope="row">{{ $livro->titulo }}</td>
                        <td>{{ $livro->autor->nome }}</td>
                        <td>{{ $livro->genero->nome }}</td>
                        <td>
                            <a href="{{ route('livros.detalhes', $livro->id) }}" class="btn btn-sm"><i
                                    class="fas fa-bars"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $livros->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        //Abrindo o modal de cadastro caso haja erro de validação
        @if (isset($msg) && $msg->tipo == 'danger')
            var myModal = new bootstrap.Modal(document.getElementById('CriarLivro'));
            myModal.show();
        @endif
    </script>
@endsection
