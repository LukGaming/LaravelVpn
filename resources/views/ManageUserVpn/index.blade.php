<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
</head> 
<div class="container">
    <div class="row">
@for ($f = 0; $f < count($usuarios); $f++)
<div class="card" style="width: 18rem; ">    
    <ul class="list-group list-group-flush float float-right" style="padding: 10px;margin: 5px;">
      <li class="list-group-item h6" style="height: 70px" > Ip da Vpn<div class="h5">{{ $usuarios[$f]['ip_vpn'] }}</div>  <br></li>
      <li class="list-group-item h6" style="height: 70px" >Ultima conexão <div class="h5">{{ $usuarios[$f]['dia'] }} - {{ $usuarios[$f]['mes'] }} - {{ $usuarios[$f]['hora'] }}</div> <br> <br></li>
      <li class="list-group-item h6" style="height: 70px"> Ip publico <div class="h6">{{ $usuarios[$f]['ip_publico'] }}</div> <br></li>
      <li class="list-group-item h6" style="height: 100px" >Usuario<br> <div class="h5">{{ $usuarios[$f]['nome_usuario'] }}</div><br><br></li>
    </ul>
  </div>   
@endfor
</div>
