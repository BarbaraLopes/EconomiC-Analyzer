<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

require_once "conexao.php";
require_once "classes/city.php";

class cityDAO
{

    public function remover($city)
    {
        global $pdo;
        try {
            $statementS = $pdo->prepare("SELECT id_payment FROM tb_payments WHERE tb_city_id_city = :id");
            $statementS->bindValue(":id", $city->getIdCity());
            $statementS->execute();
            $dados = $statementS->fetchAll(PDO::FETCH_OBJ);

            if (empty($dados)) {
            $statement = $pdo->prepare("DELETE FROM tb_city WHERE id_city = :id");
            $statement->bindValue(":id", $city->getIdCity());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            }
            else{
                return "Registro não pode ser excluído pois ele está sendo referenciado em pagamento.";
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($city)
    {
        global $pdo;
        try {
            if ($city->getIdCity() != "") {
                $statement = $pdo->prepare("UPDATE tb_city SET str_name_city=:str_name_city, str_cod_siafi_city=:str_cod_siafi_city, tb_state_id_state=:tb_state_id_state  WHERE id_city = :id;");
                $statement->bindValue(":id", $city->getIdCity());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_city (str_name_city, str_cod_siafi_city, tb_state_id_state) VALUES (:str_name_city, :str_cod_siafi_city, :tb_state_id_state)");
            }
            $statement->bindValue(":str_name_city", $city->getStrNameCity());
            $statement->bindValue(":str_cod_siafi_city", $city->getStrCodSiafiCity());
            $statement->bindValue(":tb_state_id_state", $city->getTbStateIdState());

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

    public function atualizar($city)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_city, str_name_city, str_cod_siafi_city, tb_state_id_state FROM tb_city WHERE id_city = :id");
            $statement->bindValue(":id", $city->getIdCity());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $city->setIdCity($rs->id_city);
                $city->setStrNameCity($rs->str_name_city);
                $city->setStrCodSiafiCity($rs->str_cod_siafi_city);
                $city->setTbStateIdState($rs->tb_state_id_state);
                return $city;
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
        $sql = "SELECT id_city, str_name_city, str_cod_siafi_city, tb_state_id_state FROM tb_city LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Instrução de consulta para paginação com MySQL */
        $sql2 = "SELECT c.id_city, c.str_name_city, c.str_cod_siafi_city, s.str_uf FROM tb_city c, tb_state s WHERE c.tb_state_id_state = s.id_state order by c.id_city LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement2 = $pdo->prepare($sql2);
        $statement2->execute();
        $dados_com_state = $statement2->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_city";
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

        if (!empty($dados_com_state)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Id</th>
        <th>Nome Cidade</th>
        <th>Codigo Siafi Cidade</th>
        <th>Estado</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados_com_state as $var):
                echo "<tr>
        <td>$var->id_city</td>
        <td>$var->str_name_city</td>
        <td>$var->str_cod_siafi_city</td>
        <td>$var->str_uf</td>
        <td><a href='?act=upd&id=$var->id_city'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$var->id_city'><i class='ti-close'></i></a></td>
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