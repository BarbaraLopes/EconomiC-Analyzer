<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

require_once "conexao.php";
require_once "classes/payment.php";

class paymentDAO
{

    public function remover($payment)
    {
        global $pdo;
        try {

            $statement = $pdo->prepare("DELETE FROM tb_payments WHERE id_payment = :id");
            $statement->bindValue(":id", $payment->getIdPayment());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }

        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($payment)
    {
        global $pdo;
        try {
            if ($payment->getIdPayment() != "") {
                $statement = $pdo->prepare("UPDATE tb_payments SET tb_city_id_city=:tb_city_id_city, tb_functions_id_function=:tb_functions_id_function, 
                                                      tb_subfunctions_id_subfunction=:tb_subfunctions_id_subfunction, tb_program_id_program=:tb_program_id_program,
                                                      tb_action_id_action=:tb_action_id_action, tb_beneficiaries_id_beneficiaries=:tb_beneficiaries_id_beneficiaries,
                                                      tb_source_id_source=:tb_source_id_source, tb_files_id_file=:tb_files_id_file, int_month=:int_month, int_year=:int_year,
                                                      db_value=:db_value WHERE id_payment = :id;");
                $statement->bindValue(":id", $payment->getIdPayment());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_payments (tb_city_id_city, tb_functions_id_function, tb_subfunctions_id_subfunction, tb_program_id_program,
                                                      tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source, tb_files_id_file, int_month, int_year, db_value) 
                                                      VALUES (:tb_city_id_city, :tb_functions_id_function, :tb_subfunctions_id_subfunction, :tb_program_id_program,
                                                      :tb_action_id_action, :tb_beneficiaries_id_beneficiaries, :tb_source_id_source, :tb_files_id_file, :int_month, :int_year, :db_value)");
            }
            $statement->bindValue(":tb_city_id_city", $payment->getTbCityIdCity());
            $statement->bindValue(":tb_functions_id_function", $payment->getTbFunctionsIdFunction());
            $statement->bindValue(":tb_subfunctions_id_subfunction", $payment->getTbSubfunctionsIdSubfunction());
            $statement->bindValue(":tb_program_id_program", $payment->getTbProgramIdProgram());
            $statement->bindValue(":tb_action_id_action", $payment->getTbActionIdAction());
            $statement->bindValue(":tb_beneficiaries_id_beneficiaries", $payment->getTbBeneficiariesIdBeneficiaries());
            $statement->bindValue(":tb_source_id_source", $payment->getTbSourceIdSource());
            $statement->bindValue(":tb_files_id_file", $payment->getTbFilesIdFile());
            $statement->bindValue(":int_month", $payment->getIntMonth());
            $statement->bindValue(":int_year", $payment->getIntYear());
            $statement->bindValue(":db_value", $payment->getDbValue());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($payment)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_payment, tb_city_id_city, tb_functions_id_function, tb_subfunctions_id_subfunction, tb_program_id_program,
                                                        tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source, tb_files_id_file, int_month, int_year, db_value
                                                        FROM tb_payments WHERE id_payment = :id");
            $statement->bindValue(":id", $payment->getIdPayment());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $payment->setIdPayment($rs->id_payment);
                $payment->setTbCityIdCity($rs->tb_city_id_city);
                $payment->setTbFunctionsIdFunction($rs->tb_functions_id_function);
                $payment->setTbSubfunctionsIdSubfunction($rs->tb_subfunctions_id_subfunction);
                $payment->setTbProgramIdProgram($rs->tb_program_id_program);
                $payment->setTbActionIdAction($rs->tb_action_id_action);
                $payment->setTbBeneficiariesIdBeneficiaries($rs->tb_beneficiaries_id_beneficiaries);
                $payment->setTbSourceIdSource($rs->tb_source_id_source);
                $payment->setTbFilesIdFile($rs->tb_files_id_file);
                $payment->setIntMonth($rs->int_month);
                $payment->setIntYear($rs->int_year);
                $payment->setDbValue($rs->db_value);
                return $payment;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 2);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT id_payment, tb_city_id_city, tb_functions_id_function, tb_subfunctions_id_subfunction, tb_program_id_program,
                        tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source, tb_files_id_file, int_month, int_year, db_value
                        FROM tb_payments LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Instrução de consulta para paginação com MySQL */
        $sql2 = "SELECT * FROM tb_payments pay, 
                        tb_city c, tb_functions f, tb_subfunctions sub, tb_program prog, tb_action a,
                        tb_beneficiaries b, tb_source s, tb_files fi, tb_state st WHERE pay.tb_city_id_city = c.id_city AND 
                        pay.tb_functions_id_function = f.id_function AND pay.tb_subfunctions_id_subfunction = sub.id_subfunction AND 
                        pay.tb_program_id_program = prog.id_program AND pay.tb_action_id_action = a.id_action AND pay.tb_beneficiaries_id_beneficiaries = b.id_beneficiaries AND 
                        pay.tb_source_id_source = s.id_source AND pay.tb_files_id_file = fi.id_file AND c.tb_state_id_state = st.id_state order by pay.id_payment LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement2 = $pdo->prepare($sql2);
        $statement2->execute();
        $dados_com_join = $statement2->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_payments";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados_com_join)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Id</th>
        <th>Cidade</th>
        <th>Fun</th>
        <th>Sub</th>
        <th>Prog</th>
        <th>Ação</th>
        <th>Beneficiário</th>
        <th>Fonte</th>
        <th>Arquivo</th>
        <th>Mês</th>
        <th>Ano</th>
        <th>Valor</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados_com_join as $var):
                echo "<tr>
        <td>$var->id_payment</td>
        <td>$var->str_name_city</td>
        <td>$var->str_cod_function</td>
        <td>$var->str_cod_subfunction</td>
        <td>$var->str_cod_program</td>
        <td>$var->str_cod_action</td>
        <td>$var->str_nis</td>
        <td>$var->str_goal</td>
        <td>$var->str_name_file</td>
        <td>$var->int_month</td>
        <td>$var->int_year</td>
        <td>$var->db_value</td>
        <td><a href='?act=upd&id=$var->id_payment'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$var->id_payment'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
       <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }

}