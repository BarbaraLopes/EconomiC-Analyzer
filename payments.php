<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:16
 */

include_once "estrutura/Template.php";
require_once "db/paymentDAO.php";
require_once "classes/payment.php";

$template = new Template();
$object = new paymentDAO();

$template->header();
$template->sidebar();
$template->mainpanel();


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $StrCity = (isset($_POST["StrCity"]) && $_POST["StrCity"] != null) ? $_POST["StrCity"] : "";
    $StrFunction = (isset($_POST["StrFunction"]) && $_POST["StrFunction"] != null) ? $_POST["StrFunction"] : "";
    $StrSubFunction = (isset($_POST["StrSubFunction"]) && $_POST["StrSubFunction"] != null) ? $_POST["StrSubFunction"] : "";
    $StrProgram = (isset($_POST["StrProgram"]) && $_POST["StrProgram"] != null) ? $_POST["StrProgram"] : "";
    $StrAction = (isset($_POST["StrAction"]) && $_POST["StrAction"] != null) ? $_POST["StrAction"] : "";
    $StrBeneficiaries = (isset($_POST["StrBeneficiaries"]) && $_POST["StrBeneficiaries"] != null) ? $_POST["StrBeneficiaries"] : "";
    $StrSource = (isset($_POST["StrSource"]) && $_POST["StrSource"] != null) ? $_POST["StrSource"] : "";
    $StrFiles = (isset($_POST["StrFiles"]) && $_POST["StrFiles"] != null) ? $_POST["StrFiles"] : "";
    $StrMonth = (isset($_POST["StrMonth"]) && $_POST["StrMonth"] != null) ? $_POST["StrMonth"] : "";
    $StrYear = (isset($_POST["StrYear"]) && $_POST["StrYear"] != null) ? $_POST["StrYear"] : "";
    $StrValue = (isset($_POST["StrValue"]) && $_POST["StrValue"] != null) ? $_POST["StrValue"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $StrCity = NULL;
    $StrFunction = NULL;
    $StrSubFunction = NULL;
    $StrProgram = NULL;
    $StrAction = NULL;
    $StrBeneficiaries = NULL;
    $StrSource = NULL;
    $StrFiles = NULL;
    $StrMonth = NULL;
    $StrYear = NULL;
    $StrValue = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $payment = new payment($id, '', '', '', '', '','', '','','','','');

    $resultado = $object->atualizar($payment);
    $StrCity = $resultado->getTbCityIdCity();
    $StrFunction = $resultado->getTbFunctionsIdFunction();
    $StrSubFunction = $resultado->getTbSubfunctionsIdSubfunction();
    $StrProgram = $resultado->getTbProgramIdProgram();
    $StrAction = $resultado->getTbActionIdAction();
    $StrBeneficiaries = $resultado->getTbBeneficiariesIdBeneficiaries();
    $StrSource = $resultado->getTbSourceIdSource();
    $StrFiles = $resultado->getTbFilesIdFile();
    $StrMonth = $resultado->getIntMonth();
    $StrYear = $resultado->getIntYear();
    $StrValue = $resultado->getDbValue();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $StrCity != "" && $StrFunction != "" && $StrSubFunction != "" && $StrProgram != "" &&
    $StrAction != "" && $StrBeneficiaries != "" && $StrSource != "" && $StrFiles != "" && $StrMonth != "" &&
    $StrYear != "" && $StrValue != "") {
    $payment = new payment($id, $StrCity, $StrFunction, $StrSubFunction, $StrProgram, $StrAction, $StrBeneficiaries, $StrSource, $StrFiles, $StrMonth, $StrYear, $StrValue);
    $msg = $object->salvar($payment);
    $id = null;
    $StrCity = NULL;
    $StrFunction = NULL;
    $StrSubFunction = NULL;
    $StrProgram = NULL;
    $StrAction = NULL;
    $StrBeneficiaries = NULL;
    $StrSource = NULL;
    $StrFiles = NULL;
    $StrMonth = NULL;
    $StrYear = NULL;
    $StrValue = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $payment = new payment($id, '', '', '', '', '','', '','','','','');
    $msg = $object->remover($payment);
    $id = null;
}

?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Payment</h4>
                        <p class='category'>payments</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1">
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" name="id" value="<?php
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>"/>
                            Cidade - UF:
                            <select name="StrCity" required>
                                <?php
                                $query = "SELECT * FROM tb_city c, tb_state s WHERE c.tb_state_id_state = s.id_state;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_city == $StrCity) {
                                            echo "<option value='$rs->id_city' selected>$rs->str_name_city - $rs->str_uf</option>";
                                        } else {
                                            echo "<option value='$rs->id_city'>$rs->str_name_city - $rs->str_uf</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            Função:
                            <select name="StrFunction" required>
                                <?php
                                $query = "SELECT * FROM tb_functions;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_function == $StrFunction) {
                                            echo "<option value='$rs->id_function' selected>$rs->str_cod_function - $rs->str_name_function</option>";
                                        } else {
                                            echo "<option value='$rs->id_function'>$rs->str_cod_function - $rs->str_name_function</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            SubFunção:
                            <select name="StrSubFunction" required>
                                <?php
                                $query = "SELECT * FROM tb_subfunctions;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_subfunction == $StrSubFunction) {
                                            echo "<option value='$rs->id_subfunction' selected>$rs->str_cod_subfunction - $rs->str_name_subfunction</option>";
                                        } else {
                                            echo "<option value='$rs->id_subfunction'>$rs->str_cod_subfunction - $rs->str_name_subfunction</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            
                            <br>
                            <br>
                            &nbsp;
                            &nbsp;
                            &nbsp;
							Programa:
                            <select name="StrProgram" required>
                                <?php
                                $query = "SELECT * FROM tb_program;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_program == $StrProgram) {
                                            echo "<option value='$rs->id_program' selected>$rs->str_cod_program - $rs->str_name_program</option>";
                                        } else {
                                            echo "<option value='$rs->id_program'>$rs->str_cod_program - $rs->str_name_program</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            Ação:
                            <select name="StrAction" required>
                                <?php
                                $query = "SELECT * FROM tb_action;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_action == $StrAction) {
                                            echo "<option value='$rs->id_action' selected>$rs->str_cod_action - $rs->str_name_action</option>";
                                        } else {
                                            echo "<option value='$rs->id_action'>$rs->str_cod_action - $rs->str_name_action</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            
                            <br>
                            <br>
                            &nbsp;
                            &nbsp;
                            &nbsp;
							Beneficiário:
                            <select name="StrBeneficiaries" required>
                                <?php
                                $query = "SELECT * FROM tb_beneficiaries;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_beneficiaries == $StrBeneficiaries) {
                                            echo "<option value='$rs->id_beneficiaries' selected>$rs->str_nis - $rs->str_name_person</option>";
                                        } else {
                                            echo "<option value='$rs->id_beneficiaries'>$rs->str_nis - $rs->str_name_person</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            Fonte:
                            <select name="StrSource" required>
                                <?php
                                $query = "SELECT * FROM tb_source;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_source == $StrSource) {
                                            echo "<option value='$rs->id_source' selected>$rs->str_goal</option>";
                                        } else {
                                            echo "<option value='$rs->id_source'>$rs->str_goal</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
							<br>
                            <br>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            Arquivo:
                            <select name="StrFiles" required>
                                <?php
                                $query = "SELECT * FROM tb_files;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->id_file == $StrFiles) {
                                            echo "<option value='$rs->id_file' selected>$rs->str_name_file</option>";
                                        } else {
                                            echo "<option value='$rs->id_file'>$rs->str_name_file</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
							<br>
                            <br>
                            &nbsp;
                            &nbsp;
                            &nbsp;
                            Mês:
                            <input type="number" size="2" min="1" max="99" name="StrMonth" required value="<?php
                            echo (isset($StrMonth) && ($StrMonth != null || $StrMonth != "")) ? $StrMonth : '';
                            ?>"/>
                            Ano:
                            <input type="number" size="4" min="1" max="9999" name="StrYear" required value="<?php
                            echo (isset($StrYear) && ($StrYear != null || $StrYear != "")) ? $StrYear : '';
                            ?>"/>
                            Valor:
                            <input type="number" min="0.00" max="10000.00" step="0.01" name="StrValue" required value="<?php
                            echo (isset($StrValue) && ($StrValue != null || $StrValue != "")) ? $StrValue : '';
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
