<form action="{{route('login.autenticar')}}" method="POST">
      @csrf
      <input type="text" name="email" placeholder="E-mail" value="{{old('email')}}">
      <input type="password" name="password" placeholder="Senha">
      <button type="submit">Entrar</button>
</form>