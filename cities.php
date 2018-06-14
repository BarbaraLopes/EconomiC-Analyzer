<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/cityDAO.php";
require_once "classes/city.php";

$template = new Template();
$object = new cityDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_name_city = (isset($_POST["str_name_city"]) && $_POST["str_name_city"] != null) ? $_POST["str_name_city"] : "";
    $str_cod_siafi_city = (isset($_POST["str_cod_siafi_city"]) && $_POST["str_cod_siafi_city"] != null) ? $_POST["str_cod_siafi_city"] : "";
    $tb_state_id_state = (isset($_POST["tb_state_id_state"]) && $_POST["tb_state_id_state"] != null) ? $_POST["tb_state_id_state"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_name_city = NULL;
    $str_cod_siafi_city = NULL;
    $tb_state_id_state = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $city = new city($id, '', '', '');

    $resultado = $object->atualizar($city);
    $str_name_city = $resultado->getStrNameCity();
    $str_cod_siafi_city = $resultado->getStrCodSiafiCity();
    $tb_state_id_state = $resultado->getTbStateIdState();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_city != "" && $str_cod_siafi_city != ""  && $tb_state_id_state != "") {
    $city = new city($id, $str_name_city, $str_cod_siafi_city, $tb_state_id_state);
    $msg = $object->salvar($city);
    $id = null;
    $str_name_city = NULL;
    $str_cod_siafi_city = NULL;
    $tb_state_id_state = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $city = new city($id, '', '', '');
    $msg = $object->remover($city);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>city</h4>
                        <p class='category'>citys</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Nome Cidade:
                            <input type="text" size="50" maxlength="50" name="str_name_city" required value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($str_name_city) && ($str_name_city != null || $str_name_city != "")) ? $str_name_city : '';
                            ?>"/>
                            Codigo Siafi Cidade:
                            <input type="number" size="4" min="1" max="9999" name="str_cod_siafi_city" required value="<?php
                            // Preenche o sigla no campo sigla com um valor "value"
                            echo (isset($str_cod_siafi_city) && ($str_cod_siafi_city != null || $str_cod_siafi_city != "")) ? $str_cod_siafi_city : '';
                            ?>"/>
                            Estado:
                            <select name="tb_state_id_state" required>
                                <?php
                                $query = "SELECT * FROM tb_state;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_state == $tb_state_id_state) {
                                            echo "<option value='$rs->id_state' selected>$rs->str_uf</option>";
                                        } else {
                                            echo "<option value='$rs->id_state'>$rs->str_uf</option>";
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
