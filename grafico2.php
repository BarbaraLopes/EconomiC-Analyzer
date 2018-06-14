<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 09:49
 */

require_once "PHPlot/phplot.php";

require_once "db/conexao.php";

#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new PHPlot(400,500);

$variavel = $_REQUEST['variavel'];
$lista = explode(" / ", $variavel);

#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Beneficiários X Estado");
$grafico->SetYTitle("Beneficiários");
$grafico->SetXTitle("Estado");

$query = "SELECT 
    count(t.id_beneficiaries) as b, e.int_month as m, g.str_uf AS estado
FROM
    db_eca.tb_beneficiaries t,
    db_eca.tb_payments e,
    db_eca.tb_city f,
    db_eca.tb_state g
WHERE
    e.tb_beneficiaries_id_beneficiaries = t.id_beneficiaries
        AND e.tb_city_id_city = f.id_city
        AND f.tb_state_id_state = g.id_state
        AND e.int_month = :mes
        AND e.int_year = :ano
GROUP BY e.int_month , g.str_name
order by g.str_name, e.int_month;";
$statement = $pdo->prepare($query);
$statement->bindValue(":mes", $lista[0]);
$statement->bindValue(":ano", $lista[1]);
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rs as $value) {
    $resultado[] = $value;
}

$data = array();

if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [$r['estado'], $r['b']];
    }
} else {
    $data[]=[null,null];
}

$grafico->SetDefaultTTFont('D:\xampp\htdocs\EconomiC-Analyzer\assets\fonts\Timeless.ttf');

$grafico->SetDataValues($data);

$grafico->SetLegend($variavel);

$grafico->SetPlotType("bars");

$grafico->SetOutputFile('graf2.png');

#Exibimos o gráfico
$grafico->DrawGraph();