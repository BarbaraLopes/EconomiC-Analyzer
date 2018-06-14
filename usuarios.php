<?php


include_once "estrutura/Template.php";
require_once "db/usuarioDAO.php";
require_once "classes/usuario.php";

$template = new Template();
$object = new usuarioDAO();

$template->header();
$template->sidebar();
$template->mainpanel();

$perfil = $_SESSION['perfil'];

if($perfil == 'user'){
    echo "<script>location.href='index.php';</script>";
}


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != null) ? $_POST["usuario"] : "";
    $senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $resetar = (isset($_POST["resetar"]) && $_POST["resetar"] != null) ? $_POST["resetar"] : "";
    $perfil = (isset($_POST["perfil"]) && $_POST["perfil"] != null) ? $_POST["perfil"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $usuario = NULL;
    $senha = NULL;
    $nome = NULL;
    $email = NULL;
    $resetar = NULL;
    $perfil = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $user = new usuario($id, '','','','','', '');

    $resultado = $object->atualizar($user);
    $usuario = $resultado->getUsuario();
    $senha = null;
    $nome = $resultado->getNome();
    $email = $resultado->getEmail();
    $resetar = $resultado->getResetar();
    $perfil = $resultado->getPerfil();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save") {
    if ($usuario != "" && $senha != "" && $nome != "" && $email != "" && $resetar != "" && $perfil != "") {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $user = new usuario($id, $usuario, $senha, $nome, $email, $resetar, $perfil);
            $msg = $object->salvar($user);
            $id = null;
            $usuario = null;
            $senha = null;
            $nome = null;
            $email = null;
            $resetar = null;
            $perfil = null;
        } else {
            $msg = "Email inválido!";
        }
    }
    else{
        $msg = "Existem campos em branco, favor preencher corretamente!";
    }
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $user = new usuario($id, '','','','','', '');
    $msg = $object->remover($user);
    $id = null;
}

?>

    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Usuários</h4>
                            <p class='category'>Lista de usuarios do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save&id=" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" size="5" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                                ?>" />
                                Usuario:
                                <input type="text" size="50" maxlength="50" name="usuario" required value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($usuario) && ($usuario != null || $usuario != "")) ? $usuario : '';
                                ?>" />
                                Senha:
                                <input type="password" size="20" maxlength="20" name="senha" required value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($senha) && ($senha != null || $senha != "")) ? $senha : '';
                                ?>" />
                                &nbsp;Nome:
                                <input type="text" size="50" name="nome" required value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                                ?>" />
                                <br>
                                <br>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                Email:
                                &nbsp;<input type="text" size="50" name="email" required value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($email) && ($email != null || $email != "")) ? $email : '';
                                ?>" />
                                Resetar:
                                <select name="resetar" required>
                                    <option value="">Selecione</option>
                                    <option value="0" <?php if(isset($resetar) && $resetar=="0") echo 'selected'?>>Não</option>
                                    <option value="1" <?php if(isset($resetar) && $resetar=="1") echo 'selected'?>>Sim</option>
                                </select>
                                Perfil:
                                <select name="perfil" required>
                                    <option value="">Selecione</option>
                                    <option value="admin" <?php if(isset($perfil) && $perfil=="admin") echo 'selected'?>>Admin</option>
                                    <option value="user" <?php if(isset($perfil) && $resetar=="user") echo 'selected'?>>User</option>
                                </select>
                                <input type="submit" VALUE="Cadastrar"/>
                                <hr>
                            </form>
                            <?php
                            echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                            //chamada a paginação
                            $object->tabelapaginada();

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$template->footer();
?>