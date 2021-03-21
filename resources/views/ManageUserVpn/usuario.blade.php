<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        .online {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 3px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 20px;
        }

        .offline {
            background-color: rgb(245, 94, 94);
            /* Green */
            border: none;
            color: white;
            padding: 3px;
            */ text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 20px;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            /*border-bottom: 1px dotted black;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

    </style>
</head>

<body>
    <li class="list-group-item" id="online" style="height: 70px">
        <span id="span-ping" class="mouseover_ping_again">
        </span><br><br></li>
</body>

</html>

<script>
    function pingstats() {
        $.ajax({
            url: 'http://192.168.0.155:8000/ping/' + ip_usuario,
            success: function(data) {
                if (data['ping'] == "Usuário Desconectado") {
                    spans.append("<div class='offline'>Offline</div>");
                } else {
                    spans.append(
                        "<div class='online tooltip'  style='opacity: 1' id='online'>Online<span class='tooltiptext' id=span_ping>" +
                        data['ping'] + "</span></div>");
                }
                console.log(data['ping']);
            }
        });
    }
    $(document).ready(function() {
        spans = $("#span-ping");
        usuario = "pauloantonioferreiramendes";
        ip_usuario = "10.8.0.2";
        pingstats();
        var $testa_pinga = $(".mouseover_ping_again");
        console.log($testa_pinga);
            $($testa_pinga).mouseover(function() {
                $.ajax({
                url: 'http://192.168.0.155:8000/ping/' + ip_usuario,
                success: function(data) {
                    if (data['ping'] != "Usuário Desconectado") {
                        $("#span_ping").html(data['ping']); 
                    } 
                }
            });
        });        
    });
</script>
