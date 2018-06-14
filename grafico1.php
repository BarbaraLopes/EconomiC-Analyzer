<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 09:49
 */

require_once "PHPlot/phplot.php";

require_once "db/conexao.php";

$grafico = new PHPlot(600,250);

$grafico->SetTitle("Beneficiários X Mês/Ano");
$grafico->SetYTitle("Beneficiários");
$grafico->SetXTitle("Mês/Ano");

$query = "select count(t.id_beneficiaries) as b, CONCAT(e.int_month, ' / ', e.int_year) as y from db_eca.tb_beneficiaries t, db_eca.tb_payments e
          where e.tb_beneficiaries_id_beneficiaries = t.id_beneficiaries
          group by e.int_month, e.int_year order by e.int_month, e.int_year;";
$statement = $pdo->prepare($query);
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rs as $value) {
    $resultado[] = $value;
}

$data = array();

if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [$r['y'], $r['b']];
    }
} else {
    $data[]=[null,null];
}

$grafico->SetDefaultTTFont('D:\xampp\htdocs\EconomiC-Analyzer\assets\fonts\Timeless.ttf');

$grafico->SetDataValues($data);

$grafico->SetPlotType("lines");

$grafico->SetOutputFile('graf.png');

#Exibimos o gráfico
$grafico->DrawGraph();