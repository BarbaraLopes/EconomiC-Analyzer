<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/sourceDAO.php";
require_once "classes/source.php";

$template = new Template();
$object = new sourceDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrGoal = (isset($_POST["StrGoal"]) && $_POST["StrGoal"] != null) ? $_POST["StrGoal"] : "";
    $StrOrigin = (isset($_POST["StrOrigin"]) && $_POST["StrOrigin"] != null) ? $_POST["StrOrigin"] : "";
    $StrPeriodicity = (isset($_POST["StrPeriodicity"]) && $_POST["StrPeriodicity"] != null) ? $_POST["StrPeriodicity"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrGoal = NULL;
    $StrOrigin = NULL;
    $StrPeriodicity = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $source = new source($id, '', '', '');

    $resultado = $object->atualizar($source);
    $StrGoal = $resultado->getStrGoal();
    $StrOrigin = $resultado->getStrOrigin();
    $StrPeriodicity = $resultado->getStrPeriodicity();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrGoal != "" && $StrOrigin != ""  && $StrPeriodicity != "") {
    $source = new source($id, $StrGoal, $StrOrigin, $StrPeriodicity);
    $msg = $object->salvar($source);
    $id = null;
    $StrGoal = NULL;
    $StrOrigin = NULL;
    $StrPeriodicity = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $source = new source($id, '', '', '');
    $msg = $object->remover($source);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Source</h4>
                        <p class='category'>sources</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Goal:
                            <input type="text" size="50" maxlength="50" name="StrGoal" required value="<?php
                            echo (isset($StrGoal) && ($StrGoal != null || $StrGoal != "")) ? $StrGoal : '';
                            ?>"/>
                            Origin:
                            <input type="text" size="50" maxlength="50" name="StrOrigin" required value="<?php
                            echo (isset($StrOrigin) && ($StrOrigin != null || $StrOrigin != "")) ? $StrOrigin : '';
                            ?>"/>
                            Periodicity:
                            <input type="text" size="9" maxlength="9" name="StrPeriodicity" required value="<?php
                            echo (isset($StrPeriodicity) && ($StrPeriodicity != null || $StrPeriodicity != "")) ? $StrPeriodicity : '';
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
