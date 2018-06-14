<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/beneficiaryDAO.php";

$template = new Template();
$object = new beneficiaryDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_nis = (isset($_POST["str_nis"]) && $_POST["str_nis"] != null) ? $_POST["str_nis"] : "";
    $str_name_person = (isset($_POST["str_name_person"]) && $_POST["str_name_person"] != null) ? $_POST["str_name_person"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_nis = NULL;
    $str_name_person = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $beneficiary = new beneficiary($id, '', '');

    $resultado = $object->atualizar($beneficiary);
    $str_nis = $resultado->getStrNis();
    $str_name_person = $resultado->getStrNamePerson();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_nis != "" && $str_name_person != "") {
    $beneficiary = new beneficiary($id, $str_nis, $str_name_person);
    $msg = $object->salvar($beneficiary);
    $id = null;
    $str_nis = NULL;
    $str_name_person = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $beneficiary = new beneficiary($id, '', '');
    $msg = $object->remover($beneficiary);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Beneficiary</h4>
                        <p class='category'>beneficiarys</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nis:
                            <input type="text" size="14" maxlength="14" name="str_nis" required value="<?php
                            echo (isset($str_nis) && ($str_nis != null || $str_nis != "")) ? $str_nis : '';
                            ?>"/>
                            Nome Pessoa:
                            <input type="text" size="50" maxlength="50" name="str_name_person" required value="<?php
                            echo (isset($str_name_person) && ($str_name_person != null || $str_name_person != "")) ? $str_name_person : '';
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
