<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/actionDAO.php";
require_once "classes/action.php";

$template = new Template();
$object = new actionDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrCodAction = (isset($_POST["StrCodAction"]) && $_POST["StrCodAction"] != null) ? $_POST["StrCodAction"] : "";
    $StrNameAction = (isset($_POST["StrNameAction"]) && $_POST["StrNameAction"] != null) ? $_POST["StrNameAction"] : "";


} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrCodAction = NULL;
    $StrNameAction = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $action = new action($id, '', '');

    $resultado = $object->atualizar($action);
    $StrCodAction = $resultado->getStrCodAction();
    $StrNameAction = $resultado->getStrNameAction();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrCodAction != "" && $StrNameAction != "") {
    $action = new action($id, $StrCodAction, $StrNameAction);
    $msg = $object->salvar($action);
    $id = null;
    $StrCodAction = NULL;
    $StrNameAction = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $action = new action($id, '', '');
    $msg = $object->remover($action);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Action</h4>
                        <p class='category'>actions</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Codigo Ação:
                            <input type="number" size="4" max="9999" name="StrCodAction" required value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($StrCodAction) && ($StrCodAction != null || $StrCodAction != "")) ? $StrCodAction : '';
                            ?>"/>
                            Nome Ação:
                            <input type="text" size="50" maxlength="50" name="StrNameAction" required value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($StrNameAction) && ($StrNameAction != null || $StrNameAction != "")) ? $StrNameAction : '';
                            ?>"/>
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
