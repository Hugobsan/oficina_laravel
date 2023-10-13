@extends('layouts.interno')

@section('titulo')
    {{ $livro->titulo }} - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>{{ $livro->titulo }}</h1>
        @if (auth()->user()->admin)
            <!-- Modal button -->
            <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#EditarLivro">
                <i class="fas fa-pen-to-square"></i> Editar
            </button>

            <!-- Modal -->
            @include('livros.components.editar')
        @endif
    </div>
    <div class="bg-white mx-3 my-2 p-4 rounded">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Autor:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->autor->nome }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Gênero:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->genero->nome }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Volume:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->volume }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Edição:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->edicao }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Nº de Pág.:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->numero_paginas }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <p><strong>Quant. De Exemplares:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->quantidade }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>ISBN:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->isbn }}</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <p><strong>Editora:</strong></p>
                <p class="border-bottom border-secondary p-2">{{ $livro->editora }}</p>
            </div>
        </div>
    </div>

    <div class="box-historico bg-white mx-3 my-2 p-4 rounded h-50">
        <h1>Histórico de Empréstimo</h1>
        @forelse($livro->emprestimos as $emprestimo)
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
                        <p>{{ $emprestimo->locatario->nome }}</p>
                    </div>
                    <div>
                        <p class="@if ($emprestimo->atrasado) text-danger @else text-secondary @endif">Data para
                            Devolução: {{ $emprestimo->data_devolucao_esperada }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Não há histórico de empréstimo para este livro.</p>
        @endforelse
    </div>
@endsection

<script>
    //Abrindo o modal caso haja erro de validação
    @if (isset($msg) && $msg->tipo == 'danger')
        var myModal = new bootstrap.Modal(document.getElementById('EditarLivro'));
        myModal.show();
    @endif
</script>
