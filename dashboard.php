
<?php

require_once "estrutura/template.php";
require_once "db/dashboardDAO.php";

$template = new Template();
$object = new dashboardDAO();

$template->header();

$template->sidebar();

$template->mainpanel();

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-server"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Payments</p>
                                        <?php
                                        echo $object->dashboardTotal();
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info"></i> Total sum
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-wallet"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Payments</p>
                                    R$ <?php
                                    echo $object->dashboardSoma();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-calendar"></i> Last Month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-pulse"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Average</p>
                                    R$<?php
                                    echo $object->dashboardMedia();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-timer"></i> In the last month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Beneficiaries</p>
                                    <?php
                                    echo $object->dashboardBeneficiario();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr/>
                            <div class="stats">
                                <i class="ti-info"></i> Total
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Monthly beneficiaries</h4>
                        <p class="category">Every year</p>
                    </div>
                    <div class="content">
                        <div id="chartHours" class="ct-chart">
                            <div style="text-align:center"><?php echo "<img src=grafico1.php />"; ?></div>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="ti-info-alt"></i> Historic Serie | <i class="ti-export"></i><a href="fpdf/relatorioDash1.php"  target="_blank"> Export PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Beneficiaries by state</h4>
                        <p class="category">Monthly update</p>
                        <?php

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $mesAno = (isset($_POST["mesAno"]) && $_POST["mesAno"] != null) ? $_POST["mesAno"] : "";
                            $mesAnoV = (isset($_POST["mesAnoV"]) && $_POST["mesAnoV"] != null) ? $_POST["mesAnoV"] : "";
                        }

                        ?>
                        <form action="?act=graf" method="POST" name="form1">
                        Mês/Ano:
                        <select name="mesAno">
                            <?php
                            $query = "SELECT 
                                        DISTINCT(CONCAT(e.int_month, ' / ', e.int_year)) as mesAno
                                      FROM
                                        db_eca.tb_beneficiaries t, db_eca.tb_payments e, db_eca.tb_city f, db_eca.tb_state g
                                      WHERE
                                        e.tb_beneficiaries_id_beneficiaries = t.id_beneficiaries
                                      AND e.tb_city_id_city = f.id_city
                                      AND f.tb_state_id_state = g.id_state
                                      GROUP BY e.int_month , g.str_name
                                      order by e.int_month, e.int_year;";
                            $statement = $pdo->prepare($query);
                            if ($statement->execute()) {
                                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                echo "<option value=''>Selecione</option>";
                                foreach ($result as $rs) {
                                    if ($rs->mesAno == $mesAno) {
                                        echo "<option value='$rs->mesAno' selected>$rs->mesAno</option>";
                                    } else {
                                        echo "<option value='$rs->mesAno'>$rs->mesAno</option>";
                                    }
                                }
                            } else {
                                throw new PDOException("Erro: Não foi possível executar a declaração sql");
                            }
                            ?>
                        </select>
                            <input type="submit" VALUE="Gerar gráfico"/>

                    </div>
                    <div class="content">
                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth">
                            <?php if(!empty($mesAno)){
                                echo "<div style=\"text-align:center\"><img src='grafico2.php?variavel=$mesAno' method='post' /></div>"; } ?>
                        </div>

                        <div class="footer">

                            <hr>
                            <div class="stats">
                                <i class="ti-timer"></i> Total | <i class="ti-export"></i>
                                <?php if(!empty($mesAno)){
                                    echo "<a href=\"fpdf/relatorioDash2.php?variavel=$mesAno\" target=\"_blank\"> Export PDF</a>"; }
                                    else{
                                    echo "<a> Export PDF</a>";
                                    }?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Values per state</h4>
                        <p class="category">Monthly update</p>


                            Mês/Ano:
                            <select name="mesAnoV">
                                <?php
                                $query = "SELECT 
                                        DISTINCT(CONCAT(e.int_month, ' / ', e.int_year)) as mesAno
                                      FROM
                                        db_eca.tb_beneficiaries t, db_eca.tb_payments e, db_eca.tb_city f, db_eca.tb_state g
                                      WHERE
                                        e.tb_beneficiaries_id_beneficiaries = t.id_beneficiaries
                                      AND e.tb_city_id_city = f.id_city
                                      AND f.tb_state_id_state = g.id_state
                                      GROUP BY e.int_month , g.str_name
                                      order by e.int_month, e.int_year;";
                                $statement = $pdo->prepare($query);
                                if ($statement->execute()) {
                                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                    echo "<option value=''>Selecione</option>";
                                    foreach ($result as $rs) {
                                        if ($rs->mesAno == $mesAnoV) {
                                            echo "<option value='$rs->mesAno' selected>$rs->mesAno</option>";
                                        } else {
                                            echo "<option value='$rs->mesAno'>$rs->mesAno</option>";
                                        }
                                    }
                                } else {
                                    throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                }
                                ?>
                            </select>
                            <input type="submit" VALUE="Gerar gráfico"/>
                        </form>
                    </div>
                    <div class="content">
                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth">
                            <?php if(!empty($mesAnoV)){
                                echo "<div style=\"text-align:center\"><img src='grafico3.php?variavel2=$mesAnoV' method='post' /></div>"; } ?>
                        </div>

                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="ti-check"></i> Last Month | <i class="ti-export"></i>
                                <?php if(!empty($mesAnoV)){
                                    echo "<a href=\"fpdf/relatorioDash3.php?variavel2=$mesAnoV\" target=\"_blank\"> Export PDF</a>"; }
                                else{
                                    echo "<a> Export PDF</a>";
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$template->footer();

?>