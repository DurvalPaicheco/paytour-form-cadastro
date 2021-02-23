<?php

namespace App\Http\Controllers;

use App\Mail\SendMailCadastro;
use App\Models\Pessoa;
use App\Models\Cargos;
use App\Models\Escolaridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FormularioController extends Controller
{
    protected $file_type = ['doc', 'docx', 'pdf'];

    public function index(){

        $cargos = Cargos::all();
        $escolaridades = Escolaridade::all();
        
        return view('formulario.index',compact('cargos','escolaridades'));
    }

    

    protected function clearSqlI($value){
        return str_replace(array("<", ">", "\\", "/", "=", "'", "?",'select', '*', 'from', 'grant', 'all'), "", strtolower($value));
    }

    public function enviaCurriculo(Request $request){
        $dados = $request->all();
        $email = $this->clearSqlI($dados['email']);
        $email_existe = Pessoa::where('email',$email)->first();
        if(!empty($email_existe)){
            return json_encode('Email já cadastrado, logo entraremos em contato.');
        }
        $file = $request->file('curriculo');
        $filename = $file->getClientOriginalName();
        $extencao = pathinfo($filename, PATHINFO_EXTENSION);

        if(!in_array($extencao, $this->file_type)){ 

            return json_encode('Extesão inválida!');
        }

        $size = filesize($file);
        if($size > 100000){
            return json_encode('Tamanho máximo de 1MB!'. $size);
        }

        $upload =  $file->store('curriculos');

        $name =  explode("/", $upload);

        

        $nome = $this->clearSqlI($dados['nome']);
        
        $telefone = $this->clearSqlI($dados['telefone']);
        $cargo = $this->clearSqlI($dados['cargo']);
        $escolaridade = $this->clearSqlI($dados['escolaridade']);
        $obs = $this->clearSqlI($dados['obs']);
        $savPessoa = array(
            "nome" => $nome,
            "email" => $email,
            "telefone" => $telefone,
            "cargo" => $cargo,
            "escolaridade" => $escolaridade,
            "obs" => $obs,
            "curriculo"=> $name[1],
            "ip" => $this->get_client_ip()
        );
        
        /*Mail::to('to@email.com')
        ->cc('copy@email.com')
        ->send(new SendMailCadastro());*/

        Mail::to($this->clearSqlI($dados['email']), $nome)->send(new SendMailCadastro());
        
        $resp = Pessoa::create($savPessoa);
        if($resp != false){
            $resp = 1;
        }else{
            $resp = 'Houve um erro ao enviar os dados, por favor tente novamente';
        }

        
        return json_encode($resp);
        
        

        

    }

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
