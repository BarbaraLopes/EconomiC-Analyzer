<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/functionDAO.php";
require_once "classes/functions.php";

$template = new Template();
$object = new functionDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrNameFunction = (isset($_POST["StrNameFunction"]) && $_POST["StrNameFunction"] != null) ? $_POST["StrNameFunction"] : "";
    $StrCodFunction = (isset($_POST["StrCodFunction"]) && $_POST["StrCodFunction"] != null) ? $_POST["StrCodFunction"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrNameFunction = NULL;
    $StrCodFunction = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $functions = new functions($id, '', '');

    $resultado = $object->atualizar($functions);
    $StrNameFunction = $resultado->getStrNameFunction();
    $StrCodFunction = $resultado->getStrCodFunction();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrNameFunction != "" && $StrCodFunction != "") {
    $functions = new functions($id, $StrCodFunction, $StrNameFunction);
    $msg = $object->salvar($functions);
    $id = null;
    $StrNameFunction = NULL;
    $StrCodFunction = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $functions = new functions($id, '', '');
    $msg = $object->remover($functions);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Function</h4>
                        <p class='category'>functions</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Código:
                            <input type="number" size="4" min="1" max="9999" name="StrCodFunction" required value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($StrCodFunction) && ($StrCodFunction != null || $StrCodFunction != "")) ? $StrCodFunction : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" maxlength="50" name="StrNameFunction" required value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($StrNameFunction) && ($StrNameFunction != null || $StrNameFunction != "")) ? $StrNameFunction : '';
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
