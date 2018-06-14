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
$pdf->Image('graf.png',5,12,200,0,'');
$pdf->AliasNbPages();
$pdf->Output();
?>