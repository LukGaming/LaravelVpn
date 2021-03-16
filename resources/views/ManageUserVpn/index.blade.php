<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@for ($f = 0; $f < count($usuarios); $f++) 
    Ip da Vpn: {{$usuarios[$f]['ip_vpn']}}<br>
    Hora da ultima conexão: {{$usuarios[$f]['dia']}} - {{$usuarios[$f]['mes']}} - {{$usuarios[$f]['hora']}} <br>
    Ip publico: {{ $usuarios[$f]['ip_publico']}}<br>
    usuario:  {{$usuarios[$f]['nome_usuario']}}<br>
    <span id="{{$f}}"></span> 
    <br>
    <br>
    
@endfor
<script>
    function pingstats(){
        $.ajax({
            url: "http://192.168.0.155:8000/ping/10.8.0.2",
            success: function(data) {
                for(i=0; i<data['ping'].length; i++){
                        //console.log(data['ping'][i]);
                    spans[i].innerHTML = data['ping'][i];
                    console.log(data['ping'][i]);

                }
            }
        });
    }
$(document).ready(function() {    
    spans = document.querySelectorAll("span");
    pingstats();                         
});
        
</script>


