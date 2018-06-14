<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/stateDAO.php";
require_once "classes/state.php";

$template = new Template();
$object = new stateDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrUf = (isset($_POST["StrUf"]) && $_POST["StrUf"] != null) ? $_POST["StrUf"] : "";
    $StrName = (isset($_POST["StrName"]) && $_POST["StrName"] != null) ? $_POST["StrName"] : "";
    $IdRegion = (isset($_POST["IdRegion"]) && $_POST["IdRegion"] != null) ? $_POST["IdRegion"] : "";


} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrUf = NULL;
    $StrName = NULL;
    $IdRegion = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $state = new state($id, '','','');

    $resultado = $object->atualizar($state);
    $StrUf = $resultado->getStrUf();
    $StrName = $resultado->getStrName();
    $IdRegion = $resultado->getTbRegionIdRegion();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrUf != "" && $StrName != "" && $IdRegion != "") {
    $state = new state($id, $StrUf, $StrName, $IdRegion);
    $msg = $object->salvar($state);
    $id = null;
    $StrUf = NULL;
    $StrName = NULL;
    $IdRegion = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $state = new state($id, '', '', '');
    $msg = $object->remover($state);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>State</h4>
                        <p class='category'>states</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Uf:
                            <input type="text" size="2" maxlength="2" name="StrUf" required value="<?php
                            echo (isset($StrUf) && ($StrUf != null || $StrUf != "")) ? $StrUf : '';
                            ?>"/>
                            Nome:
                            <input type="text" size="19" maxlength="19" name="StrName" required value="<?php
                            echo (isset($StrName) && ($StrName != null || $StrName != "")) ? $StrName : '';
                            ?>"/>
                            Região:
                            <select name="IdRegion" required>
                                <?php
                                $query = "SELECT * FROM tb_region;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_region == $IdRegion) {
                                            echo "<option value='$rs->id_region' selected>$rs->str_name_region</option>";
                                        } else {
                                            echo "<option value='$rs->id_region'>$rs->str_name_region</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
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
