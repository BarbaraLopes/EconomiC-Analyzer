<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/subfunctionsDAO.php";
require_once "classes/subfunction.php";

$template = new Template();
$object = new subfunctionsDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrCod = (isset($_POST["StrCod"]) && $_POST["StrCod"] != null) ? $_POST["StrCod"] : "";
    $StrName = (isset($_POST["StrName"]) && $_POST["StrName"] != null) ? $_POST["StrName"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrCod = NULL;
    $StrName = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $subfunction = new subfunction($id, '', '', '');

    $resultado = $object->atualizar($subfunction);
    $StrCod = $resultado->getStrCodSubfunction();
    $StrName = $resultado->getStrNameSubfunction();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrCod != "" && $StrName != "" ) {
    $subfunction = new subfunction($id, $StrCod, $StrName);
    $msg = $object->salvar($subfunction);
    $id = null;
    $StrCod = NULL;
    $StrName = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $subfunction = new subfunction($id, '', '', '');
    $msg = $object->remover($subfunction);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Subfunction</h4>
                        <p class='category'>subfunctions</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Código:
                            <input type="number" size="4" max="9999" name="StrCod" required value="<?php
                            echo (isset($StrCod) && ($StrCod != null || $StrCod != "")) ? $StrCod : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" maxlength="50" name="StrName" required value="<?php
                            echo (isset($StrName) && ($StrName != null || $StrName != "")) ? $StrName : '';
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
