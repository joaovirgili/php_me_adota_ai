<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar CCZ</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar CCZ </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">CNPJ</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="cnpj" type="text" placeholder="CNPJ" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($CNPJErro)): ?>
                            <span class="help-inline"><?php echo $CNPJErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($enderecoErro)?'error ': '';?>">
                    <label class="control-label">Area de Atuação</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="area" type="text" placeholder="Area de Atuação" required="" value="<?php echo !empty($endereco)?$endereco: '';?>">
                        <?php if(!empty($AtuacaoErro)): ?>
                            <span class="help-inline"><?php echo $AtuacaoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($telefoneErro)?'error ': '';?>">
                    <label class="control-label">Localização</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="localizacao" type="text" placeholder="Localização" required="" value="<?php echo !empty($telefone)?$telefone: '';?>">
                        <?php if(!empty($localizacaoErro)): ?>
                            <span class="help-inline"><?php echo $localizacaoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="ccz.php" type="btn" class="btn btn-default">Voltar</a>

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
        $CNPJErro = null;
        $AtuacaoErro = null;
        $localizacaoErro = null;

        $cnpj = $_POST['cnpj'];
        $area = $_POST['area'];
        $localizacao = $_POST['localizacao'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($cnpj))
        {
            $nomeErro = 'Por favor digite o cnpj!';
            $validacao = false;
        }

        if(empty($area))
        {
            $enderecoErro = 'Por favor digite a area';
            $validacao = false;
        }

        if(empty($localizacao))
        {
            $telefoneErro = 'Por favor digite a localizacao!';
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
