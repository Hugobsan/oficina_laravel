@extends('layouts.interno')

@section('titulo')
    {{ $livro->titulo }} - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>{{ $livro->titulo}}</h1>
        <!-- Modal button -->
        <button type="button" class="btn-new" data-bs-toggle="modal" data-bs-target="#EditarLivro">
            <i class="fas fa-pen-to-square"></i> Editar
        </button>

        <!-- Modal -->
        @include('livros.components.editar')
    </div>
@endsection

@section('script')
    <script></script>
@endsection
