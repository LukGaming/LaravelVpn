<?php

namespace App\Http\Controllers;


use App\Models\ManageUserVpn;
use Illuminate\Http\Request;

class ManageUserVpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastLoggedUsers()
    {
        $resultado = shell_exec("cat /var/log/syslog | grep 'MULTI: primary virtual IP for'");
        $resultado = str_replace("server openvpn[717]:", "", $resultado);
        $resultado = str_replace(" MULTI: primary virtual IP for", " ", $resultado);
        $resultado = str_replace("Mar", "+Mar", $resultado);
        $strings = explode("+", $resultado);
        $usuarios = array();
        $string_cortadas_por_espaco = array();
        for ($i = 0; $i < count($strings); $i++) {                        //Transformar cada string no indice i em um vetor dentro de um vetor
            $array_por_espaco = explode(" ", $strings[$i]);
            array_push($string_cortadas_por_espaco, $array_por_espaco);
        }
        for ($j = 1; $j < count($string_cortadas_por_espaco); $j++) {
            if (count($string_cortadas_por_espaco[$j]) == 7) {
                $usuario = array();
                $separando_ip_de_nome_usuario = explode("/", $string_cortadas_por_espaco[$j][5]);
                $usuario[$j]['dia'] = $string_cortadas_por_espaco[$j][1];
                $usuario[$j]['mes'] = $string_cortadas_por_espaco[$j][0];
                $usuario[$j]['hora'] = $string_cortadas_por_espaco[$j][2];
                $usuario[$j]['nome_usuario'] = $separando_ip_de_nome_usuario[0];
                $usuario[$j]['ip_vpn'] = $string_cortadas_por_espaco[$j][6];
                $usuario[$j]['ip_publico'] = $separando_ip_de_nome_usuario[1];
                array_push($usuarios, $usuario[$j]);
            }
            if (count($string_cortadas_por_espaco[$j]) == 8) {
                $usuario = array();
                $separando_ip_de_nome_usuario = explode("/", $string_cortadas_por_espaco[$j][6]);
                $usuario[$j]['dia'] = $string_cortadas_por_espaco[$j][1];
                $usuario[$j]['mes'] = $string_cortadas_por_espaco[$j][0];
                $usuario[$j]['hora'] = $string_cortadas_por_espaco[$j][2];
                $usuario[$j]['nome_usuario'] = $separando_ip_de_nome_usuario[0];
                $usuario[$j]['ip_vpn'] = $string_cortadas_por_espaco[$j][7];
                $usuario[$j]['ip_publico'] = $separando_ip_de_nome_usuario[1];
                array_push($usuarios, $usuario[$j]);
            }
            if (count($string_cortadas_por_espaco[$j]) == 9) {
                $usuario = array();
                $separando_ip_de_nome_usuario = explode("/", $string_cortadas_por_espaco[$j][7]);
                $usuario[$j]['dia'] = $string_cortadas_por_espaco[$j][1];
                $usuario[$j]['mes'] = $string_cortadas_por_espaco[$j][0];
                $usuario[$j]['hora'] = $string_cortadas_por_espaco[$j][2];
                $usuario[$j]['nome_usuario'] = $separando_ip_de_nome_usuario[0];
                $usuario[$j]['ip_vpn'] = $string_cortadas_por_espaco[$j][8];
                $usuario[$j]['ip_publico'] = $separando_ip_de_nome_usuario[1];
                array_push($usuarios, $usuario[$j]);
            }
        }
        return $usuarios;
    }

    public function index()
    {
        $usuarios =  $this->lastLoggedUsers();
        /*for ($f = 0; $f < count($usuarios); $f++) {
                echo "<br>";
                echo "Ip da Vpn " . $usuarios[$f]['ip_vpn'] . "<br>";
                echo "Hora da ultima conexão: " . $usuarios[$f]['dia'] . "-" . $usuarios[$f]['mes'] . "-" . $usuarios[$f]['hora'] . "<br>";
                echo "Ip publico: " . $usuarios[$f]['ip_publico'] . "<br>";
                echo "usuario: " . $usuarios[$f]['nome_usuario'];
                echo "<br>";
                echo "<span id=".$f."></span>";
                //echo $this->verifyIfUserIsConnectToVpn($usuarios[$f]['ip_vpn']);
                echo "<br>";
        }*/

        return view('ManageUserVpn/index', ['usuarios' => $usuarios]);
    }
    public function verifyIfUserIsConnectToVpn($ip_user) //Essa função verifica se o usuário está conectado a VPN
    {
        $host = $ip_user;
        $ping = new \JJG\Ping($host);
        $ping->setTtl(128);
        $ping->setTimeout(1);
        $latency = $ping->ping();
        if ($latency !== false) {
            //print 'Latency is ' . $latency . ' ms';
            return "Usuário Conectado, ping de: $latency ms";
        } else {
            return 'Usuário Desconectado';
        }
    }
    public function ping($ip)
    {
        /*$usuarios =  $this->lastLoggedUsers();
        $pings_usuarios = array();
        for ($p = 0; $p < count($usuarios); $p++) {
            $ping = $this->verifyIfUserIsConnectToVpn($usuarios[$p]["ip_vpn"]);
            array_push($pings_usuarios, $ping);
        }*/
        $ping_usuario = $this->verifyIfUserIsConnectToVpn($ip);
        return response()->json(
            ["ping" => $ping_usuario]
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //echo shell_exec("ls /compartilhada");
        //echo shell_exec("bash /compartilhada/new_client.sh vitao59");
        return view('ManageUserVpn/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        echo shell_exec('bash /compartilhada/new_client.sh '.$request->nome_usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageUserVpn  $manageUserVpn
     * @return \Illuminate\Http\Response
     */
    public function show(ManageUserVpn $manageUserVpn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageUserVpn  $manageUserVpn
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageUserVpn $manageUserVpn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageUserVpn  $manageUserVpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageUserVpn $manageUserVpn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageUserVpn  $manageUserVpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageUserVpn $manageUserVpn)
    {
        //
    }
    public function usuario($id_usuario){
        return view('ManageUserVpn/usuario');
    }
}
