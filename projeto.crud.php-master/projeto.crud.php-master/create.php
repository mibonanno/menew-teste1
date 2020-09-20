

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $cidadeErro = null;
    $estadoErro = null;
    $categoriaErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }


        if (!empty($_POST['telefone'])) {
            $endereco = $_POST['telefone'];
        } else {
            $enderecoErro = 'Por favor digite o seu telefone!';
            $validacao = False;
        }


        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }


        if (!empty($_POST['cidade'])) {
            $cidade = $_POST['cidade'];
        } else {
            $cidadeErro = 'Por favor digite sua cidade!';
            $validacao = False;
        }

        if (!empty($_POST['estado'])) {
            $cidade = $_POST['estado'];
        } else {
            $cidadeErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }

        if (!empty($_POST['categoria'])) {
            $cidade = $_POST['categoria'];
        } else {
            $cidadeErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pessoa (nome,telefone, email, cidade, estado, categoria) VALUES(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $telefone, $email, $cidade, $estado, $categoria));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


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

                    <div class="control-group  <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="control-group <?php echo !empty($telefoneErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Telefone</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="telefone" type="text" placeholder="Telefone"
                                   value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span class="text-danger"><?php echo $telefoneErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="email" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>          
                                
                    
                    <div class="control-group <?php echo !empty($cidadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="cidade" type="text" placeholder="cidade"
                                   value="<?php echo !empty($cidade) ? $cidade : ''; ?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="text-danger"><?php echo $cidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>                 
                    
                    
                    <div class="control-group <?php !empty($estadoErro) ? 'echo($estadoErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label"></label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="estado" id="estado"
                                           value="UF" <?php isset($_POST["estado"]) && $_POST["estado"] == "SP" ? "checked" : null; ?>/>
                                    São Paulo</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="estado" name="estado" type="radio"
                                           value="UF" <?php isset($_POST["estado"]) && $_POST["estado"] == "RJ" ? "checked" : null; ?>/>
                                    Rio de Janeiro</p>
                            </div>

                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="estado" name="estado" type="radio"
                                           value="UF" <?php isset($_POST["estado"]) && $_POST["estado"] == "MG" ? "checked" : null; ?>/>
                                    Minas Gerais</p>
                            </div>

                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="estado" name="estado" type="radio"
                                           value="UF" <?php isset($_POST["estado"]) && $_POST["estado"] == "SC" ? "checked" : null; ?>/>
                                    Santa Catarina </p>
                            </div>

                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="estado" name="estado" type="radio"
                                           value="UF" <?php isset($_POST["estado"]) && $_POST["estado"] == "DF" ? "checked" : null; ?>/>
                                    Distrito Federal</p>
                            </div>
                            <?php if (!empty($estadoErro)): ?>
                                <span class="help-inline text-danger"><?php echo $estadoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($categoriaErro) ? 'echo($categoriaErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label"></label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="categoria" name="categoria" id="categoria"
                                           value="C" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "C" ? "checked" : null; ?>/>
                                    Cliente</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="categoria" name="categoria" type="radio"
                                           value="F" <?php isset($_POST["categoria"]) && $_POST["categoria"] == "F" ? "checked" : null; ?>/>
                                    Fornecedor</p>
                            </div>
                            
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="categoria" name="categoria" type="radio"
                                           value="FN" <?php isset($_POST["estado"]) && $_POST["estado"] == "FN" ? "checked" : null; ?>/>
                                    Funcionário </p>
                            </div>
                            
                            <?php if (!empty($estadoErro)): ?>
                                <span class="help-inline text-danger"><?php echo $estadoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

