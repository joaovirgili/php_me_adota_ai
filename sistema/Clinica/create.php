<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Contato</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($cnpjErro)?'error ' : '';?>">
                    <label class="control-label">CNPJ</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="cnpj" type="text" placeholder="cnpj" required="" value="<?php echo !empty($cnpj)?$cnpj: '';?>">
                        <?php if(!empty($cnpjErro)): ?>
                            <span class="help-inline"><?php echo $cnpjErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nomeErro)?'error ': '';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>
                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="clinica.php" type="btn" class="btn btn-default">Voltar</a>

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
        $cnpjErro = null;
        $nomeErro = null;
        $telefoneErro = null;

        $cnpj = $_POST['cnpj'];
        $nome = $_POST['nome'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($cnpj))
        {
            $cnpjErro = 'Por favor digite o seu cnpj!';
            $validacao = false;
        }

        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($telefone))
        {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, Endereço, telefone, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$Endereço,$telefone,$email,$sexo));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
