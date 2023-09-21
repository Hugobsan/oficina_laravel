<form action="{{route('login.autenticar')}}">
      @csrf
      <input type="text" name="email" placeholder="E-mail">
      <input type="password" name="senha" placeholder="Senha">
      <button type="submit">Entrar</button>
</form>