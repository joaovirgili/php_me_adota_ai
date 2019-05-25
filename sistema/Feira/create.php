<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Feira</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Feira </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <label class="control-label">Tipo</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_feira" name="tipo_feira" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="Vacina">Vacina</option>
                                    <option value="Adocao">Adoção</option>
                            </select>
                        </div>
                </div>

                <label class="control-label">Organizador</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_organizador" name="tipo_organizador" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="ccz">CCZ</option>
                                    <option value="ong">ONG</option>
                            </select>
                        </div>
                </div>

                <div class="control-group <?php echo !empty($aberturaErro)?'error ' : '';?>">
                    <label class="control-label">Abertura</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="abertura" type="text" placeholder="Abertura" required="" value="<?php echo !empty($abertura)?$abertura: '';?>">
                        <?php if(!empty($aberturaErro)): ?>
                            <span class="help-inline"><?php echo $aberturaErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($encerramentoErro)?'error ': '';?>">
                    <label class="control-label">Encerramento</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="encerramento" type="text" placeholder="Encerramento" required="" value="<?php echo !empty($encerramento)?$encerramento: '';?>">
                        <?php if(!empty($encerramentoErro)): ?>
                            <span class="help-inline"><?php echo $encerramentoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($enderecoErro)?'error ': '';?>">
                    <label class="control-label">Endereço</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="endereco" type="text" placeholder="Endereço" required="" value="<?php echo !empty($endereco)?$endereco: '';?>">
                        <?php if(!empty($enderecoErro)): ?>
                            <span class="help-inline"><?php echo $enderecoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <label class="control-label">CNPJ</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_cnpj" name="tipo_cnpj" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="CNPJ1">CNPJ1</option>
                                    <option value="CNPJ2">CNPJ2</option>
                            </select>
                        </div>
                </div>
                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="feira.php" type="btn" class="btn btn-default">Voltar</a>

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
        $tipo_feira = null;
        $organizador = null;
        $aberturaErro = null;
        $encerramentoErro = null;
        $enderecoErro = null;
        $cnpjErro = null;

        $tipo_feira = $_POST['tipo_feira'];
        $organizador = $_POST['organizador'];
        $abertura = $_POST['abertura'];
        $encerramento = $_POST['encerramento'];
        $endereco = $_POST['endereco'];
        $cnpj = $_POST['cnpj'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($tipo_feira))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($organizador))
        {
            $encerramentoErro = 'Por favor digite o seu endereço!';
            $validacao = false;
        }

        if(empty($abertura))
        {
            $enderecoErro = 'Por favor digite o número do endereco!';
            $validacao = false;
        }

        if(empty($endereco))
        {
            $enderecoErro = 'Por favor digite o endereço de email';
            $validacao = false;
        }

        if(empty($cnpj))
        {
            $sexoErro = 'Por favor digite o campo!';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, encerramento, endereco, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$encerramento,$endereco,$email,$sexo));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
