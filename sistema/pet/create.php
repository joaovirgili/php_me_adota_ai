<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Pet</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Pet </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($porteErro)?'error ': '';?>">
                    <label class="control-label">Porte</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="porte" type="text" placeholder="Porte" required="" value="<?php echo !empty($porte)?$porte: '';?>">
                        <?php if(!empty($porteErro)): ?>
                            <span class="help-inline"><?php echo $porteErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($racaErro)?'error ': '';?>">
                    <label class="control-label">Raça</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="raca" type="text" placeholder="Raça" required="" value="<?php echo !empty($raca)?$raca: '';?>">
                        <?php if(!empty($racaErro)): ?>
                            <span class="help-inline"><?php echo $racaErro;?></span>
                            <?php endif;?>
                    </div>
                </div>
                    <label class="control-label">Sexo</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_sexo" name="tipo_sexo" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="Macho">Macho</option>
                                    <option value="Femea">Femea</option>
                            </select>
                        </div>
                </div>

                <div class="control-group <?php echo !empty($fotoErro)?'error ': '';?>">
                    <label class="control-label">Foto</label>
                    <div class="controls">
                        <input type="hidden" name="foto" value="4194304" required="required" />
                        <input type="file" />
                    </div>
                </div>
                
                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="pet.php" type="btn" class="btn btn-default">Voltar</a>

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
        $nomeErro = null;
        $porteErro = null;
        $racaErro = null;
        $fotoErro = null;
        $sexoErro = null;

        $nome = $_POST['nome'];
        $porte = $_POST['porte'];
        $raca = $_POST['raca'];
        $foto = $_POST['foto'];
        $sexo = $_POST['sexo'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($porte))
        {
            $porteErro = 'Por favor digite o seu endereço!';
            $validacao = false;
        }

        if(empty($raca))
        {
            $racaErro = 'Por favor digite o número do raca!';
            $validacao = false;
        }

        if(empty($foto))
        {
            $fotoErro = 'Por favor digite o endereço de email';
            $validacao = false;
        }
        if(empty($sexo))
        {
            $sexoErro = 'Por favor digite o campo!';
            $validacao = false;
        }


        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, porte, raca, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$porte,$raca,$email,$sexo));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
