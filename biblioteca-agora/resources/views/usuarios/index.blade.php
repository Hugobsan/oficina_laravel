@extends('layouts.interno')

@section('titulo')
    Usuários - Biblioteca Ágora
@endsection

@section('content')
    <div class="topo">
        <h1>Usuários</h1>
    </div>
    <div class="tabela table-responsive">
        <div>
            <form action="{{ route('usuarios.pesquisar') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-11">
                        <input type="text" class="form-control" name="pesquisa" placeholder="Pesquise...">
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
                    <th scope="col">E-mail</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td scope="row">{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <a href="{{ route('usuarios.perfil', $usuario->id) }}" class="btn btn-sm"><i
                                    class="fas fa-bars"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
