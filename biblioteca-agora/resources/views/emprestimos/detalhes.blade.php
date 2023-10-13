@extends('layouts.interno')

@section('titulo')
    Empréstimo de Livro - Biblioteca Ágora
@endsection

@section('content')
    <div class="d-flex justify-content-end m-3">
        <div>
            @if ($emprestimo->data_devolucao == 'Não devolvido')
                @if(auth()->user()->admin)
                    <a href="{{route('emprestimos.devolver', $emprestimo->id)}}" class="text-decoration-none">
                        <button type="button" class="btn btn-success">
                            <i class="fas fa-undo"></i> Devolver Livro
                        </button>
                    </a>
                @endif
                @if($emprestimo->quantidade_renovacoes <= 3)
                    <a href="{{route('emprestimos.renovar', $emprestimo->id)}}">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-arrows-spin"></i>
                            Renovar empréstimo
                        </button>
                    </a>
                @endif
            @endif
        </div>
    </div>
    <div class="bg-white mx-3 my-2 p-4 rounded">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Livro:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $emprestimo->livro->titulo}}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Locatário:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $emprestimo->locatario->nome }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Data de Empréstimo:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $emprestimo->data_emprestimo }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>{{$emprestimo->data_devolucao == "Não devolvido" ? "Data de Devolução Esperada:" : "Data de Devolução:"}}</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $emprestimo->data_devolucao == "Não devolvido" ? $emprestimo->data_devolucao_esperada : $emprestimo->data_devolucao }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Quantidade de Renovações:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $emprestimo->quantidade_renovacoes }}</p>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
