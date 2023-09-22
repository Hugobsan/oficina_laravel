@extends('layouts.externo')

@section('titulo')
    Registrar - Biblioteca Ágora
@endsection

@section('content')
    <h1>Registrar-se</h1>
    <form action="{{ route('login.novo_registro') }}" method="POST">
        @csrf
        <div class="mb-1">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo"
                value="{{ old('nome') }}" required>
        </div>
        <div class="mb-1">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                value="{{ old('email') }}" required>
        </div>
        <div class="mb-1">
            <label for="senha" class="form-label">Senha</label>
            <div class="password-container">
                <input type="password" class="form-control" placeholder="Digite sua senha" name="password" id="password"
                    required>
                <i class="fa-solid fa-eye" id="eye"></i>
            </div>
        </div>
        <div class="mb-1">
            <label for="senha" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" placeholder="Digite a senha novamente" name="password_confirmation"
                required>
        </div>
        <hr>
        <button type="submit">Registrar</button>
    </form>
    <div class="mb-1">
        <a class="forgot-password" href="{{ route('login.index') }}">Já possui uma conta? Faça login</a>
    </div>
@endsection

@section('script')
@endsection
