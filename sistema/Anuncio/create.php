<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Anúncio</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Anúncio </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Título</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="titulo" type="text" placeholder="Título" required="required" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($titleErro)): ?>
                            <span class="help-inline"><?php echo $titleErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($enderecoErro)?'error ': '';?>">
                    <label class="control-label">Data</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="data" type="text" placeholder="Data" required="" value="<?php echo !empty($endereco)?$endereco: '';?>">
                        <?php if(!empty($dataErro)): ?>
                            <span class="help-inline"><?php echo $dataErro;?></span>
                            <?php endif;?>
                    </div>
                </div>


                <div class="control-group <?php echo !empty($telefoneErro)?'error ': '';?>">
                    <label class="control-label">Usuário</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="usuario" type="text" placeholder="Usuário" required="" value="<?php echo !empty($telefone)?$telefone: '';?>">
                        <?php if(!empty($usuarioErro)): ?>
                            <span class="help-inline"><?php echo $usuarioErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailErro)?'error ': '';?>">
                    <label class="control-label">Raça</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="raca" type="text" placeholder="Raça" required="" value="<?php echo !empty($email)?$email: '';?>">
                        <?php if(!empty($racaErro)): ?>
                            <span class="help-inline"><?php echo $racaErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailErro)?'error ': '';?>">
                    <label class="control-label">Porte</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="porte" type="text" placeholder="Porte" required="" value="<?php echo !empty($email)?$email: '';?>">
                        <?php if(!empty($porteErro)): ?>
                            <span class="help-inline"><?php echo $porteErro;?></span>
                            <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($enderecoErro)?'error ': '';?>">
                    <label class="control-label">Descrição</label>
                    <div class="controls">
                        <textarea size="200" class="form-control" name="descricao" type="text" placeholder="Descrição" required="" value="<?php echo !empty($endereco)?$endereco: '';?>"></textarea>
                        <?php if(!empty($descricaoErro)): ?>
                            <span class="help-inline"><?php echo $descricaoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="anuncio.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
        </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $titleErro = null;
        $dataErro = null;
        $usuarioErro = null;
        $racaErro = null;
        $porteErro = null;
        $descricaoErro = null;

        $titulo = $_POST['titulo'];
        $data = $_POST['data'];
        $usuario = $_POST['usuario'];
        $raca = $_POST['raca'];
        $porte = $_POST['porte'];
        $descricao = $_POST['descricao'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($title))
        {
            $nomeErro = 'Por favor digite o Título!';
            $validacao = false;
        }

        if(empty($data))
        {
            $enderecoErro = 'Por favor digite a data';
            $validacao = false;
        }

        if(empty($usuario))
        {
            $telefoneErro = 'Por favor digite o usuário!';
            $validacao = false;
        }

        if(empty($raca))
        {
            $telefoneErro = 'Por favor digite a raça';
            $validacao = false;
        }
        if(empty($porte))
        {
            $sexoErro = 'Por favor digite o porte do animal!';
            $validacao = false;
        }
        if(empty($descricao))
        {
            $sexoErro = 'Por favor digite a descrição do anuncio!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$endereco,$telefone,$email,$sexo));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
