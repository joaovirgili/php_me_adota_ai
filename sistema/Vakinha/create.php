<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Vakinha</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Vakinha </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Data de Inicio</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nome" type="text" placeholder="Data de Inicio" required="required" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($enderecoErro)?'error ': '';?>">
                    <label class="control-label">Data de Encerramento</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="endereco" type="text" placeholder="Data de Encerramento" required="" value="<?php echo !empty($endereco)?$endereco: '';?>">
                        <?php if(!empty($emailErro)): ?>
                            <span class="help-inline"><?php echo $enderecoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($telefoneErro)?'error ': '';?>">
                    <label class="control-label">Meta</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="telefone" type="text" placeholder="Meta" required="" value="<?php echo !empty($telefone)?$telefone: '';?>">
                        <?php if(!empty($emailErro)): ?>
                            <span class="help-inline"><?php echo $telefoneErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailErro)?'error ': '';?>">
                    <label class="control-label">Saldo Atual</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="email" type="text" placeholder="Saldo Atual" required="" value="<?php echo !empty($email)?$email: '';?>">
                        <?php if(!empty($emailErro)): ?>
                            <span class="help-inline"><?php echo $emailErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailErro)?'error ': '';?>">
                    <label class="control-label">Usuário</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="email" type="text" placeholder="Usuário" required="" value="<?php echo !empty($email)?$email: '';?>">
                        <?php if(!empty($emailErro)): ?>
                            <span class="help-inline"><?php echo $emailErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <label class="control-label">Pet</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_cartucho" name="tipo_cartucho" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="PET1">PET1</option>
                                    <option value="PET2">PET2</option>
                            </select>
                        </div>
                </div>

                <label class="control-label">Clínica</label>
                    <div class="controls">
                        <div class="">
                            <select id="tipo_cartucho" name="tipo_cartucho" class="form-control"  required>
                                <option value="">SELECIONE...</option>                                             
                                    <option value="Clinica1">Clinica1</option>
                                    <option value="Clinica2">Clinica2</option>
                            </select>
                        </div>
                </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="vakinha.php" type="btn" class="btn btn-default">Voltar</a>

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
        $enderecoErro = null;
        $telefoneErro = null;
        $emailErro = null;
        $sexoErro = null;

        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($endereco))
        {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $validacao = false;
        }

        if(empty($telefone))
        {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $validacao = false;
        }

        if(empty($email))
        {
            $telefoneErro = 'Por favor digite o endereço de email';
            $validacao = false;
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $emailError = 'Por favor digite um endereço de email válido!';
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
            $sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$endereco,$telefone,$email,$sexo));
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
