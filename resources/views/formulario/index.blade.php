<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Currículo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <script src="{{ asset('jquery/jquery.js') }}"> > </script> 
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}">  </script> 
    <script src="{{ asset('js/curriculo/envCurriculo.js') }}">  </script> 
    <meta charset="UTF-8">
    
    
</head>
<body>
    <header>
        Enviei seu Currículo
    </header>

    <div class="modal" tabindex="-1" role="dialog" id='modAlert'>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Atenção !!!</h5>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span> 
              </button> -->
            </div>
            <div class="modal-body" id='modal-conteudo'>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick='closeModal()' data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
    </div>
    
    <form action="" method="POST" id="cadastrarCurriculo" enctype="multipart/form-data">
        
        
        <div id="cont">

            <h1>Seja Bem-Vindo</h1>
            <div class="form-group" required="true" >
                <label for="exampleInputEmail1">Nome :</label>
                <input type="text" class="form-control" id="nome" aria-describedby="Insira seu nome" placeholder="Insira seu nome" name='nome'>
            </div>

            <div class="form-group" required="true">
                <label for="exampleInputEmail1">Email :</label>
                <input type="email" class="form-control" id="email" aria-describedby="Insira seu Email" placeholder="Insira seu Email" name='email'>
            </div>

            <div class="form-group" required="true">
                <label for="">Telefone :</label>
                <input type="text" class="form-control" id="telefone" aria-describedby="Insira seu telefone" placeholder="Insira seu telefone" name='telefone'>
            </div>

            <div class="form-group" required="true">
                <label for="">Cargo Desejado:</label>
                <input  type="text" class="form-control" id="cargo" name='cargo'> 
             </div>

            
            <div class="form-group" required="true">
                <label for="">Escolaridade :</label>
                <select class="form-control" id="escolaridade" name='escolaridade'> 
                    <option value="">Selecione</option>
                    @if(isset($escolaridades) && !empty($escolaridades[0]['id']))
                        @foreach($escolaridades as $escolaridade)
                            <option value='{{ $escolaridade->id }}'> {{ $escolaridade->nome }} </option>        
                        @endforeach
                    @else
                        <option value='99'>2° grau completo </option> 
                        <option value='99'>por favor rode a seeder para popular o banco </option> 
                    @endif
                </select>
            </div>

            <div class="form-group" >
                <label for="">obs :</label>
                <textarea id="obs" class="form-control" name="obs"  cols="50"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Enviar Curriculo</label>
                <input type="file" class="form-control-file" id="curriculo" name="curriculo">
            </div>
        
            <button id='enviar' type="button"  onclick='submitForm()' class="btn btn-primary">Enviar</button>
        </div>  
    </form>
       
</body>
</html>