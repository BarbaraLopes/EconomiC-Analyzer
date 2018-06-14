<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 05/01/2018
 * Time: 18:00
 */

require('fpdf181/fpdf.php');

require_once "../PHPlot/phplot.php";

require_once "../db/conexao.php";

#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new PHPlot(500,500);

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

$grafico->SetIsInline(TRUE);

#Exibimos o gráfico
$grafico->DrawGraph();

class PDF extends FPDF
{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function Footer()
    {
        //Vai para 1.5 cm da parte inferior
        $this->SetY(-15);
        //Seleciona a fonte Arial itálico 8
        $this->SetFont('Arial','I',8);
        //Imprime o número da página corrente e o total de páginas
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extract attributes
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->SetFontSize(14);
$pdf->SetLeftMargin(45);
$pdf->Image('graf2.png',5,12,200,0,'');
$pdf->AliasNbPages();
$pdf->Output();
?>