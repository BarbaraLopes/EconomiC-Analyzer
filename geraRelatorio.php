<?php
/**
 * This file is part of the PHPJasper/phpjasper
 * @author Daniel Rodrigues Lima (geekcom)
 */
require __DIR__ . '/vendor/autoload.php';

include_once "estrutura/Template.php";

$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();

use PHPJasper\PHPJasper;

class relatorio
{
    private $PHPJasper;

    /**
     * relatorio constructor.
     * @param null $PHPJasper
     */
    public function __construct($PHPJasper = null)
    {
        $this->PHPJasper = new PHPJasper();
    }

    public function DbExample($relat)
    {
        $input = __DIR__ . '/input/'.$relat.'.jrxml';
        $output = __DIR__ . '/output';
        $options = [
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [],
            'db_connection' => [
                'driver' => 'mysql', //mysql, postgres, oracle, generic (jdbc)
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'db_eca',
                'port' => '3306'
            ]
        ];
        $this->PHPJasper->process(
            $input,
            $output,
            $options
        )->execute();
    }

}

$relatorio = new relatorio;

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save1") {
	$relatorio->DbExample('report1');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save2") {
	$relatorio->DbExample('report2');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save3") {
	$relatorio->DbExample('report3');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save4") {
	$relatorio->DbExample('report4');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save5") {
	$relatorio->DbExample('report5');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save6") {
	$relatorio->DbExample('report6');
}
else if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save7") {
	$relatorio->DbExample('report7');
}
}
?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>

                        <h4 class='title'>Relatorios</h4>
                        <p class='category'>Clique no botão do relatório de sua preferência e em seguida clique no link ao lado para baixar a versão mais recente.</p>
						
                    </div>
                    <div class='content table-responsive'>
						
                         <form action="?act=save1" method="POST" name="form1">
                            <hr>
                            <input type="submit" VALUE="Relatorio 1"/>   <a href="output/report1.pdf" target="_blank">Baixar Relatorio 1</a>
                            <hr>
                        </form>
						<form action="?act=save2" method="POST" name="form2">
                            <hr>
                            <input type="submit" VALUE="Relatorio 2"/>   <a href="output/report2.pdf" target="_blank">Baixar Relatorio 2</a>
                            <hr>
                        </form>
						<form action="?act=save3" method="POST" name="form3">
                            <hr>
                            <input type="submit" VALUE="Relatorio 3"/>   <a href="output/report3.pdf" target="_blank">Baixar Relatorio 3</a>
                            <hr>
                        </form>
						<form action="?act=save4" method="POST" name="form4">
                            <hr>
                            <input type="submit" VALUE="Relatorio 4"/>   <a href="output/report4.pdf" target="_blank">Baixar Relatorio 4</a>
                            <hr>
                        </form>
						<form action="?act=save5" method="POST" name="form5">
                            <hr>
                            <input type="submit" VALUE="Relatorio 5"/>   <a href="output/report5.pdf" target="_blank">Baixar Relatorio 5</a>
                            <hr>
                        </form>
						<form action="?act=save6" method="POST" name="form6">
                            <hr>
                            <input type="submit" VALUE="Relatorio 6"/>   <a href="output/report6.pdf" target="_blank">Baixar Relatorio 6</a>
                            <hr>
                        </form>
						<form action="?act=save7" method="POST" name="form7">
                            <hr>
                            <input type="submit" VALUE="Relatorio 7"/>   <a href="output/report7.pdf" target="_blank">Baixar Relatorio 7</a>
                            <hr>
                        </form>
						
						<?php

                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';


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