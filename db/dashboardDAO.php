<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

require_once "conexao.php";

class dashboardDAO
{

    public function dashboardTotal()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT COUNT(id_payment) as total FROM tb_payments");
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                return $rs->total;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function dashboardSoma()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT format(sum(db_value),2,'de_DE') as soma FROM tb_payments  where int_month = (Select max(int_month) from tb_payments)
                                                 AND int_year = (Select max(int_year) from tb_payments)");
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                return $rs->soma;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function dashboardMedia()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT format(avg(db_value),2,'de_DE') as media FROM tb_payments  where int_month = (Select max(int_month) from tb_payments)
                                                 AND int_year = (Select max(int_year) from tb_payments)");
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                return $rs->media;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function dashboardBeneficiario()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT
                                                  count(tb_beneficiaries_id_beneficiaries) as b
                                                 FROM
                                                  tb_payments tb_payments;");
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                return $rs->b;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }


}