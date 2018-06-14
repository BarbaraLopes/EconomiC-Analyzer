<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 09/03/2018
 * Time: 21:37
 */

class Template
{

    function header()
    {
        echo "
<!doctype html>
<html lang='pt-br'>
<head>
	<meta charset='utf-8' />
	<link rel='icon' type='image/png' sizes='96x96' href='assets/img/favicon.png'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<title>EconomiC Analyzer</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name='viewport' content='width=device-width' />
    <!-- Bootstrap core CSS     -->
    <link href='assets/css/bootstrap.min.css' rel='stylesheet' />
    <!-- Animation library for notifications   -->
    <link href='assets/css/animate.min.css' rel='stylesheet'/>
    <!--  Paper Dashboard core CSS    -->
    <link href='assets/css/paper-dashboard.css' rel='stylesheet'/>
    <!--  Fonts and icons     -->
    <link href='http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href='assets/css/themify-icons.css' rel='stylesheet'>
    <!--Meu estilo-->
    <link href='assets/css/estilo.css' rel='stylesheet'>
    
";

        session_start();
        if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true) and (!isset ($_SESSION['perfil']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['perfil']);
            header('location:login.php');
        }
        echo "
</head>
<body>
";
    }


    function footer()
    {
        echo " <footer class=\"footer\">
            <div class=\"container-fluid\">
                <nav class=\"pull-left\">
                    <ul>

                        <li>
                            <a href=\"http://www.viannajr.edu.br\" target='_blank'>
                                Instituto Vianna Júnior
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class=\"copyright pull-right\">
                    &copy; <script>document.write(new Date().getFullYear())</script>, template made with <i class=\"fa fa-heart heart\"></i> by <a href=\"http://www.creative-tim.com\" target='_blank'>Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>
</body>

    <!--   Core JS file   -->
    <script src=\"assets/js/jquery-1.10.2.js\" type=\"text/javascript\"></script>
	<script src=\"assets/js/bootstrap.min.js\" type=\"text/javascript\"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src=\"assets/js/bootstrap-checkbox-radio.js\"></script>

</html>";

    }


    function sidebar()
    {
        echo "<div class=\"wrapper\">
        <div class=\"sidebar\" data-background-color=\"white\" data-active-color=\"danger\">

        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color=\"white | black\"
            Tip 2: you can change the color of the active button using the data-active-color=\"primary | info | success | warning | danger\"
        -->

        <div class=\"sidebar-wrapper\">
            <div class=\"logo\">
                <img src=\"assets/img/logo.png\" height=\"150\" width=\"200\">
                <h4>EconomiC Analyzer</h4>
            </div>

            <ul class=\"nav\">
                <li>
                    <a href=\"dashboard.php\">
                        <i class=\"ti-panel\"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
				<li>
                    <a href=\"geraRelatorio.php\">
                        <i class=\"ti-panel\"></i>
                        <p>Relatórios</p>
                    </a>
                </li>
                <li>
                    <a href=\"beneficiaries.php\">
                        <i class=\"ti-user\"></i>
                        <p>Beneficiaries</p>
                    </a>
                </li>
                <li>
                    <a href=\"programs.php\">
                        <i class=\"ti-view-list-alt\"></i>
                        <p>Programs</p>
                    </a>
                </li>
				<li>
                    <a href=\"payments.php\">
                        <i class=\"ti-money\"></i>
                        <p>Payments</p>
                    </a>
                </li>
				<li>
                    <a href=\"cities.php\">
                        <i class=\"ti-map\"></i>
                        <p>City</p>
                    </a>
                </li>
				<li>
                    <a href=\"states.php\">
                        <i class=\"ti-map\"></i>
                        <p>State</p>
                    </a>
                </li>
				<li>
                    <a href=\"regions.php\">
                        <i class=\"ti-map\"></i>
                        <p>Region</p>
                    </a>
                </li>
				<li>
                    <a href=\"functions.php\">
                        <i class=\"ti-bookmark\"></i>
                        <p>Functions</p>
                    </a>
                </li>
				<li>
                    <a href=\"files.php\">
                        <i class=\"ti-file\"></i>
                        <p>file</p>
                    </a>
                </li>
				<li>
                    <a href=\"subfunctions.php\">
                        <i class=\"ti-bookmark-alt\"></i>
                        <p>Sub Functions</p>
                    </a>
                </li>
				<li>
                    <a href=\"sources.php\">
                        <i class=\"ti-bolt-alt\"></i>
                        <p>Sources</p>
                    </a>
                </li>
				<li>
                    <a href=\"actions.php\">
                        <i class=\"ti-crown\"></i>
                        <p>Actions</p>
                    </a>
                </li>";
        $perfil = $_SESSION['perfil'];
        if($perfil == 'admin'){
            echo "<li>
                    <a href='usuarios.php'>
                        <i class='ti-user'></i>
                        <p>Usuários</p>
                    </a>
                </li>";
        }
        echo "
            </ul>

        </div>
    </div>";
    }
	
	
	function mainpanel()
    {

        echo "<div class=\"main-panel\">
        <nav class=\"navbar navbar-default\">
            <div class=\"container-fluid\">
                <div class=\"navbar-header\">
                    <button type=\"button\" class=\"navbar-toggle\">
                        <span class=\"sr-only\">Toggle navigation</span>
                        <span class=\"icon-bar bar1\"></span>
                        <span class=\"icon-bar bar2\"></span>
                        <span class=\"icon-bar bar3\"></span>
                    </button>
                    <a class=\"navbar-brand\" href=\"#\">EconomiC Analyzer</a>
                </div>
                <div class=\"collapse navbar-collapse\">
                    <ul class=\"nav navbar-nav navbar-right\">
						<li>
                                <i class='ti-calendar'></i>
								<p>";
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        echo strftime('%A, %d de %B de %Y', strtotime('today'));
        echo "
                                </p>
                        </li>
						<li>
                            <a href='sair.php'>
								<i class='ti-'></i>
								<p>Sair</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>";

    }

}