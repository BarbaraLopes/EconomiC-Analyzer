<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/fileDAO.php";
require_once "classes/file.php";

$template = new Template();
$object = new fileDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrNameFile = (isset($_POST["StrNameFile"]) && $_POST["StrNameFile"] != null) ? $_POST["StrNameFile"] : "";
    $StrMonth = (isset($_POST["StrMonth"]) && $_POST["StrMonth"] != null) ? $_POST["StrMonth"] : "";
    $StrYear = (isset($_POST["StrYear"]) && $_POST["StrYear"] != null) ? $_POST["StrYear"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrNameFile = NULL;
    $StrMonth = NULL;
    $StrYear = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $file = new file($id, '', '', '');

    $resultado = $object->atualizar($file);
    $StrNameFile = $resultado->getStrNameFile();
    $StrMonth = $resultado->getStrMonth();
    $StrYear = $resultado->getStrYear();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrNameFile != "" && $StrMonth != ""  && $StrYear != "") {
    $file = new file($id, $StrNameFile, $StrMonth, $StrYear);
    $msg = $object->salvar($file);
    $id = null;
    $StrNameFile = NULL;
    $StrMonth = NULL;
    $StrYear = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $file = new file($id, '', '', '');
    $msg = $object->remover($file);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>File</h4>
                        <p class='category'>files</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" maxlength="50" name="StrNameFile" required value="<?php
                            echo (isset($StrNameFile) && ($StrNameFile != null || $StrNameFile != "")) ? $StrNameFile : '';
                            ?>"/>
                            Mês:
                            <input type="number" size="2" min="1" max="99" name="StrMonth" required value="<?php
                            echo (isset($StrMonth) && ($StrMonth != null || $StrMonth != "")) ? $StrMonth : '';
                            ?>"/>
                            Ano:
                            <input type="number" size="4" min="1" max="9999" name="StrYear" required value="<?php
                            echo (isset($StrYear) && ($StrYear != null || $StrYear != "")) ? $StrYear : '';
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
