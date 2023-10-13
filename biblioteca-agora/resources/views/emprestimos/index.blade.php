@extends('layouts.interno')

@section('titulo')
    Empréstimos - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>Empréstimos</h1>
        @if (auth()->user()->admin)
            <!-- Modal button -->
            <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#CriarEmprestimo">
                <i class="fas fa-plus"></i> Novo Empréstimo
            </button>

            <!-- Modal -->
            @include('emprestimos.components.criar')
        @endif
    </div>
    <div class="tabela table-responsive">
        <div>
            <form action="{{ route('emprestimos.pesquisar') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="form-control" name="pesquisa"
                            placeholder="Pesquise por livro, autor, locatário ou data.">
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
                    <th scope="col">Livro</th>
                    <th scope="col">Locatário</th>
                    <th scope="col">Data de Empréstimo</th>
                    <th scope="col">Data de Devolução</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emprestimos as $emprestimo)
                    <tr>
                        <td scope="row">{{ $emprestimo->livro->titulo }}</td>
                        <td>{{ $emprestimo->locatario->nome }}</td>
                        <td>{{ $emprestimo->data_emprestimo }}</td>
                        <td>{{ $emprestimo->data_devolucao }}</td>
                        <td>
                            <a href="{{ route('emprestimos.detalhes', $emprestimo->id) }}" class="btn btn-sm"><i
                                    class="fas fa-bars"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $emprestimos->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
        //Abrindo o modal de emprestimo caso haja erro de validação
        @if (isset($msg) && $msg->tipo == 'danger')
            var myModal = new bootstrap.Modal(document.getElementById('CriarEmprestimo'));
            myModal.show();
        @endif
    </script>
@endsection
