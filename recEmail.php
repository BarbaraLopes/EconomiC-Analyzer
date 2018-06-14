<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 08/01/2018
 * Time: 16:21
 */

session_start();
$login = $_POST['usuario'];
$email = $_POST['email'];

require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";

require_once "db/usuarioDAO.php";
require_once "classes/usuario.php";

$object = new usuarioDAO();

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;

$mail->isSMTP();

$mail->SMTPDebug = 2;

$mail->Host = 'smtp.gmail.com';

$mail->Port = 587;

$mail->SMTPSecure = 'tls';

$mail->SMTPAuth = true;

$mail->Username = "trabalhotassio@gmail.com";
$mail->Password = "A1B2C3D4E5";

$statement = $pdo->prepare("SELECT idUsuario, Usuario, Senha, Nome, Email, Resetar, Perfil FROM Usuario WHERE Usuario = :login and Email = :email");
$statement->bindValue(":login", $login);
$statement->bindValue(":email", $email);
if ($statement->execute()) {
    $rs = $statement->fetch(PDO::FETCH_OBJ);
    if (!empty($rs)) {
        $usuario = new usuario('', '', '', '', '', '', '');
        $usuario->setIdUsuario($rs->idUsuario);
        $usuario->setUsuario($rs->Usuario);
        $usuario->setSenha($rs->Senha);
        $usuario->setNome($rs->Nome);
        $usuario->setEmail($rs->Email);
        $usuario->setResetar($rs->Resetar);
        $usuario->setPerfil($rs->Perfil);
        if ($usuario->getIdUsuario() != null) {
            $mail->setFrom('trabalhotassio@gmail.com', 'EconomiC Analyzer');

            $mail->addAddress($email, $usuario->getNome());

            $mail->Subject = 'Recuperacao de senha - EconomiC Analyzer';

            $mail->msgHTML("Sua nova senha é '123456' . <br> Não perca novamente!");


            if (!$mail->send()) {
                echo "Erro ao enviar o E-mail: " . $mail->ErrorInfo;
            } else {
                $usuario->setSenha("123456");
                $object->salvar($usuario);
                echo "<script>location.href='msgSucesso.php';</script>";
            }
        }
    }else {
        header('location:msgInvalido.php');
    }
}


