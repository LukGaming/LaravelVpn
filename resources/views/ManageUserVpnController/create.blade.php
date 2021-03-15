<form action="{{route('ManageUserVpn.store')}}" method="post">
    @csrf
    <input type="text" name="nome_usuario">
    <input type="submit" value="Criar usuário">
</form>