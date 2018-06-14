<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/programDAO.php";

$template = new Template();
$object = new programDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_name = (isset($_POST["str_name"]) && $_POST["str_name"] != null) ? $_POST["str_name"] : "";
    $str_cod = (isset($_POST["str_cod"]) && $_POST["str_cod"] != null) ? $_POST["str_cod"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_name = NULL;
    $str_cod = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $program = new program($id, '', '');

    $resultado = $object->atualizar($program);
    $str_cod = $resultado->getStrCodProgram();
    $str_name = $resultado->getStrNameProgram();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name != "" && $str_cod != "") {
    $program = new program($id, $str_cod, $str_name);
    $msg = $object->salvar($program);
    $id = null;
    $str_cod = NULL;
    $str_name = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $program = new program($id, '', '');
    $msg = $object->remover($program);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Program</h4>
                        <p class='category'>programs</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Código Programa:
                            <input type="number" size="4" max="9999" name="str_cod" required value="<?php
                            echo (isset($str_cod) && ($str_cod != null || $str_cod != "")) ? $str_cod : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="50" maxlength="50" name="str_name" required value="<?php
                            echo (isset($str_name) && ($str_name != null || $str_name != "")) ? $str_name : '';
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
