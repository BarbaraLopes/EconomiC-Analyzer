<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 16/03/2018
 * Time: 21:17
 */

require_once "conexao.php";
require_once "classes/state.php";

class stateDAO
{

    public function remover($state)
    {
        global $pdo;
        try {
            $statementS = $pdo->prepare("SELECT id_city FROM tb_city WHERE tb_state_id_state = :id");
            $statementS->bindValue(":id", $state->getIdState());
            $statementS->execute();
            $dados = $statementS->fetchAll(PDO::FETCH_OBJ);

            if (empty($dados)) {
            $statement = $pdo->prepare("DELETE FROM tb_state WHERE id_state = :id");
            $statement->bindValue(":id", $state->getIdState());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
            }
            else{
                return "Registro não pode ser excluído pois ele está sendo referenciado em cidades.";
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($state)
    {
        global $pdo;
        try {
            if ($state->getIdState() != "") {
                $statement = $pdo->prepare("UPDATE tb_state SET str_uf=:str_uf, str_name=:str_name, tb_region_id_region=:tb_region_id_region  WHERE id_state = :id;");
                $statement->bindValue(":id", $state->getIdState());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_state (str_uf, str_name, tb_region_id_region) VALUES (:str_uf, :str_name, :tb_region_id_region)");
            }
            $statement->bindValue(":str_uf", $state->getStrUf());
            $statement->bindValue(":str_name", $state->getStrName());
            $statement->bindValue(":tb_region_id_region", $state->getTbRegionIdRegion());

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

    public function atualizar($state)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_state, str_uf, str_name, tb_region_id_region FROM tb_state WHERE id_state = :id");
            $statement->bindValue(":id", $state->getIdState());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $state->setIdState($rs->id_state);
                $state->setStrUf($rs->str_uf);
                $state->setStrName($rs->str_name);
                $state->setTbRegionIdRegion($rs->tb_region_id_region);
                return $state;
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
        $sql = "SELECT id_state, str_uf, str_name, tb_region_id_region FROM tb_state LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Instrução de consulta para paginação com MySQL */
        $sql2 = "SELECT s.id_state, s.str_uf, s.str_name, r.str_name_region FROM tb_state s, tb_region r WHERE s.tb_region_id_region = r.id_region order by s.id_state LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement2 = $pdo->prepare($sql2);
        $statement2->execute();
        $dados_com_region = $statement2->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_state";
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

        if (!empty($dados_com_region)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Id</th>
        <th>Uf</th>
        <th>Nome</th>
        <th>Região</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados_com_region as $var):
                echo "<tr>
        <td>$var->id_state</td>
        <td>$var->str_uf</td>
        <td>$var->str_name</td>
        <td>$var->str_name_region</td>
        <td><a href='?act=upd&id=$var->id_state'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$var->id_state'><i class='ti-close'></i></a></td>
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