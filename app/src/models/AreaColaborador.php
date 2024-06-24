<?php

namespace App\Model;

use App\Utils\Util;
use GuzzleHttp\Client;
use PDO;

class AreaColaborador {

    public $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function buscarColaborador($id_empresa,$id_colaborador){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio


        $sql ="";
        $sql.="     SELECT c.pk colaborador_pk,";
        $sql.="        c.ds_colaborador,";
        $sql.="        c.ds_rg,";
        $sql.="        c.ds_cpf,";
        $sql.="        c.ds_pin,";
        $sql.="        co.pk cliente_pk,";
        $sql.="        co.id_cliente,";
        $sql.="        co.ds_conta,";
        $sql.="        co.ds_razao_social,";
        $sql.="        co.ds_cpf_cnpj,";
        $sql.="        psa.ic_status ic_status_solicitacao_app,";
        $sql.="        psa.pk novo_cadastro_pk,";
        $sql.="        psa.ds_link_imagem_cadastro";
        $sql.="     FROM colaboradores c ";
        $sql.="         LEFT JOIN contas co ON c.empresas_pk = co.pk";
        $sql.="         LEFT JOIN ponto_solicitacao_liberacao_app psa on c.pk = psa.colaborador_pk";
        $sql.="     WHERE c.pk = ".$id_colaborador;
        $sql.="     AND c.ic_status = 1";
        //$sql.="     AND psa.ic_status = 1";
        //$sql.="     AND co.ic_status = 1";
       // $sql.="     AND co.id_cliente = '".$id_empresa."'";
     


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        $retorno->data = $rows;
        $retorno->status = true;
        $retorno->message = 'Dados Salvos com sucesso !';
        return $retorno;
    }

    public function buscarColaboradorLiberado($id_empresa,$id_colaborador){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio


        $sql ="";
        $sql.="     SELECT c.pk colaborador_pk,";
        $sql.="        c.ds_colaborador,";
        $sql.="        c.ds_rg,";
        $sql.="        c.ds_cpf,";
        $sql.="        c.ds_pin,";
        $sql.="        co.pk cliente_pk,";
        $sql.="        co.id_cliente,";
        $sql.="        co.ds_conta,";
        $sql.="        co.ds_razao_social,";
        $sql.="        co.ds_cpf_cnpj,";
        $sql.="        psa.ic_status ic_status_solicitacao_app,";
        $sql.="        psa.pk novo_cadastro_pk,";
        $sql.="        psa.ds_link_imagem_cadastro";
        $sql.="     FROM colaboradores c ";
        $sql.="         LEFT JOIN contas co ON c.empresas_pk = co.pk";
        $sql.="         LEFT JOIN ponto_solicitacao_liberacao_app psa on c.pk = psa.colaborador_pk";
        $sql.="     WHERE c.pk = ".$id_colaborador;
        $sql.="     AND c.ic_status = 1";
        $sql.="     AND psa.ic_status = 1";
        //$sql.="     AND co.ic_status = 1";
       // $sql.="     AND co.id_cliente = '".$id_empresa."'";



        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        $retorno->data = $rows;
        $retorno->status = true;
        $retorno->message = 'Dados Salvos com sucesso !';
        return $retorno;
    }


    public function listarPostoTrabalho(){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql ="";
        $sql.="select distinct(l.pk), l.dt_cadastro, l.usuario_cadastro_pk, l.dt_ult_atualizacao, l.usuario_ult_atualizacao_pk ";
        $sql.="       ,case WHEN l.leads_pai_pk is null  THEN
                            l.ds_lead 
                        ELSE 
                            concat(ll.ds_lead,' - Posto:',l.ds_lead) 
                        END ds_lead";
        $sql.="       ,l.ds_endereco ";
        $sql.="       ,l.ds_numero ";
        $sql.="       ,l.ds_complemento ";
        $sql.="       ,l.ds_cep ";
        $sql.="       ,l.ds_bairro ";
        $sql.="       ,l.ds_cidade ";
        $sql.="       ,l.ds_uf ";
        $sql.="       ,case l.ic_cliente when 1 then 'Ativo' when 2 then 'Desativado' end ic_cliente ";
        $sql.="       ,l.ds_obs ";
        $sql.="       ,l.n_qtde_torres ";
        $sql.="       ,l.ds_razao_social";
        $sql.="       ,l.ds_cpf_cnpj";
        $sql.="       ,l.ds_ie";
        $sql.="       ,l.ds_tel";
        $sql.="       ,l.ds_fax";
        $sql.="       ,l.ds_site";
        $sql.="       ,l.ds_email";
        $sql.="       ,l.supervisores_pk";
        $sql.="       ,l.responsavel_pk";
        $sql.="       ,l.segmentos_pk";
        $sql.="       ,l.ic_tipo_lead";
        $sql.="       ,case l.ic_tipo_lead when 1 then 'Cliente' when 2 then 'Posto de Trabalho' end ds_tipo_lead";
        $sql.="       ,l.leads_pai_pk";
        $sql.="       ,date_format(l.dt_vencimento,'%d/%m/%Y')dt_vencimento";
        $sql.="  from leads l ";
        $sql.="  left join leads ll on l.leads_pai_pk = ll.pk";
        $sql.=" where 1=1 ";

        $sql.=" order by ds_lead asc ";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        $retorno->data = $rows;
        $retorno->status = true;
        $retorno->message = 'Dados Salvos com sucesso !';
        return $retorno;
    }

}
