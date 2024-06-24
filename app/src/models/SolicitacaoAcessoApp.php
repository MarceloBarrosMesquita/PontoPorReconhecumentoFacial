<?php

namespace App\Model;

use App\Utils\Session;
use App\Utils\Util;
use App\Utils\Validation;

class SolicitacaoAcessoApp {

	public $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

    public function excluir($pk){
        Util::execDelete('ponto_solicitacao_liberacao_app', ' pk='.$pk, $this->pdo);
    }

    public function salvar($solicitacao_acesso_app){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        
        $fields = array();
        $fields['ds_pin']  = $solicitacao_acesso_app['ds_pin'];
        $fields['colaborador_pk'] = $solicitacao_acesso_app['colaborador_pk'];
        $fields['id_cliente'] = $solicitacao_acesso_app['id_cliente'];
        $fields['ds_imagem'] = $solicitacao_acesso_app['ds_imagem'];
        
        $fields['ds_aparelho'] = $solicitacao_acesso_app['ds_aparelho'];
        $fields['usuario_aprovacao_pk'] = $solicitacao_acesso_app['usuario_aprovacao_pk'];
        $fields['obs'] = $solicitacao_acesso_app['obs'];
        $fields['ic_status'] = $solicitacao_acesso_app['ic_status'];

        if($solicitacao_acesso_app['pk']  == ""){

            $fields["dt_cadastro"] = "sysdate()";
            $fields["usuario_cadastro_pk"]   = $_SESSION['session_user']['par1'];

            $pk = Util::execInsert("ponto_solicitacao_liberacao_app", $fields,$this->pdo);
            $retorno->status = true;
            $retorno->message = 'Dados cadastrados com sucesso';
            $retorno->data = $pk;
        }
        else{
            Util::execUpdate("ponto_solicitacao_liberacao_app", $fields, " pk = ".$solicitacao_acesso_app['pk'],$this->pdo);
            $pk = $solicitacao_acesso_app['pk'];
            $retorno->status = true;
            $retorno->message = 'Dados atualizado com sucesso';
            $retorno->data = $pk;
        }
        return $retorno;
    }
    public function salvarCoordenadas($solicitacao_acesso_app){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $fields = array();
        $fields['coordenadas']  = $solicitacao_acesso_app['coordenadas'];
        Util::execUpdate("ponto_solicitacao_liberacao_app", $fields, " colaborador_pk = ".$solicitacao_acesso_app['colaborador_pk'],$this->pdo);
        $pk = $solicitacao_acesso_app['pk'];
        $retorno->status = true;
        $retorno->message = 'Dados atualizado com sucesso';
        $retorno->data = $pk;

        return $retorno;
    }

    public function liberarAcesso($solicitacao_acesso_app){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        
        $fields = array();
        $fields['ic_status'] = $solicitacao_acesso_app['ic_status'];
        $fields['usuario_aprovacao_pk'] =  $_SESSION['session_user']['par1'];
        $fields['dt_liberacao'] = "sysdate()";

        Util::execUpdate("ponto_solicitacao_liberacao_app", $fields, " pk = ".$solicitacao_acesso_app['pk'],$this->pdo);
        $pk = $solicitacao_acesso_app['pk'];
        $retorno->status = true;
        $retorno->message = 'Dados atualizado com sucesso';
        $retorno->data = $pk;
        
        return $retorno;
    }

    
    public function listarGrid($colaborador_pk,$ds_pin,$ds_re,$ic_status){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $return =[];

        //PAGINAÇÃO
        if(isset($_GET['start']) && $_GET['start']!=0){
            $displayStart = $_GET['start'];
        }
        else{
            $displayStart = 0;
        }

        if(isset($_GET['length'])){
            $displayRange = $_GET['length'];
            $lengthSql = " LIMIT ".intval($displayRange)." OFFSET ".intval($displayStart);
        }
        else{
            $lengthSql = " ";
        }
        
        $sql ="";
        $sql.="select psl.pk, psl.dt_cadastro, psl.usuario_cadastro_pk, psl.dt_ult_atualizacao, psl.usuario_ult_atualizacao_pk ";
        $sql.="       ,c.ds_colaborador";
        $sql.="       ,psl.colaborador_pk";
        $sql.="       ,psl.ds_pin";
        $sql.="       ,c.ds_re"; 
        $sql.="       ,psl.ds_link_imagem_cadastro ds_imagem";
        $sql.="       ,psl.img_colaborador_cadastro";
        $sql.="       ,date_format(psl.dt_solit_liberacao,'%d/%m/%Y %H:%m:%s')dt_solit_liberacao  ";
        $sql.="       ,date_format(psl.dt_liberacao,'%d/%m/%Y %H:%m:%s')dt_liberacao ";
        $sql.="       ,psl.usuario_aprovacao_pk ";
        $sql.="       ,u.ds_usuario ";
        $sql.="       ,psl.obs ";
        $sql.="       ,case when psl.ic_status = 1 then 'Liberado' when psl.ic_status = 2 then 'Pendente' end status  ";
        $sql.="  from ponto_solicitacao_liberacao_app psl ";
        $sql.="  inner join colaboradores c on psl.colaborador_pk = c.pk";
        $sql.="  left join usuarios u on psl.usuario_aprovacao_pk = u.pk";
        $sql.=" where 1=1 ";
        $sql.=" and c.ic_status = 1 ";

        if($colaborador_pk != ""){
            $sql.=" and psl.colaborador_pk =".$colaborador_pk;
        }        
        
        if($ds_pin != ""){
            $sql.=" and c.ds_pin like '%".$ds_pin."%' ";
        }

        if($ds_re != ""){
            $sql.=" and c.ds_re =".$ds_re;
        }

        if($ic_status != ""){
            $sql.=" and psl.ic_status =".$ic_status;
        }
        
        $sql.=" order by psl.dt_solit_liberacao asc ";


  
        $stmt = $this->pdo->prepare( $sql.$lengthSql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmtCount = $this->pdo->prepare( $sql );
        $stmtCount->execute();
        $rowsCount = $stmtCount->fetchAll(\PDO::FETCH_ASSOC);


        if(count($query) > 0){
            for($i = 0; $i < count($query); $i++){
                
                if(!empty($query[$i]['ds_imagem'])){
                    $img = "<img width=30 height=30 src='".$query[$i]['ds_imagem']."'>";
                }else{
                    $img = '<img width=30 height=30 src="data:image/png;base64,'. ($query[$i]['img_colaborador_cadastro']).'">';;
                }

                $return[] = array(
                    "t_pk" => $query[$i]["pk"],
                    "t_colaborador_pk"=>$query[$i]['colaborador_pk'],
                    "t_ds_colaborador"=>$query[$i]['ds_colaborador'],
                    "t_ds_pin"=>$query[$i]['ds_pin'],                    
                    "t_ds_re"=>$query[$i]['ds_re'],
                    "t_ds_imagem"=>$img,
                    "t_ds_link_imagem"=>$query[$i]['ds_imagem'],
                    "t_dt_solit_liberacao"=>$query[$i]['dt_solit_liberacao'],
                    "t_dt_liberacao"=>$query[$i]['dt_liberacao'],
                    "t_usuario_aprovacao_pk"=>$query[$i]['usuario_aprovacao_pk'],
                    "t_ds_usuario"=>$query[$i]['ds_usuario'],
                    "t_obs"=>$query[$i]['obs'],
                    "t_status"=>$query[$i]['status'],

                    "t_functions" => ""
                );
            }
        }


        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $return;
        $retorno->iTotalDisplayRecords = count($rowsCount);
        $retorno->iTotalRecords = count($rowsCount);

        echo json_encode($retorno);
        exit(0);
    }

    public function novoCadSolicitacaoAcessoAppPonto($dados){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        try{

            //$arrImg = json_decode($dados['img_colaborador_cadastro'], true);

            $fields = array();
            $fields['ds_pin'] = $dados['ds_pin'];
            $fields['colaborador_pk'] = $dados['colaborador_pk'];
            $fields['id_cliente'] = $dados['id_cliente'];
            $fields['img_colaborador_cadastro'] = $dados['img_colaborador_cadastro'];
            $fields['ds_link_imagem_cadastro'] = $dados['ds_link_imagem_cadastro'];
            $fields['IdTermoAceite'] = $dados['IdTermoAceite'];
            $fields['ic_tipo_app'] = $dados['ic_tipo_app'];


            $fields["dt_ult_atualizacao"] = "sysdate()";
            if(!isset($_SESSION['session_user']['par1'])){
                $fields["usuario_ult_atualizacao_pk"] = 1;
            }else{
                $fields["usuario_ult_atualizacao_pk"] = $_SESSION['session_user']['par1'];
            }

            $fields['dt_solit_liberacao'] = "sysdate()";

            $fields["dt_cadastro"] = "sysdate()";
            if(!isset($_SESSION['session_user']['par1'])){
                $fields["usuario_cadastro_pk"]   = 1;
            }else{
                $fields["usuario_cadastro_pk"]   = $_SESSION['session_user']['par1'];
            }

            //FORMATO PARA PEGAR A IMG ou com o base64_decode()
            /*echo '<img src="data:image/gif;base64,', ($imgData),'">';;
            exit();*/

            $pk = Util::execInsert("ponto_solicitacao_liberacao_app", $fields,$this->pdo);
            $retorno->status = true;
            $retorno->message = 'Dados cadastrados com sucesso';
            $retorno->data = $pk;

            return $retorno;
        }
        catch(\Throwable $e){
            $retorno->status = false;
            $retorno->message = $e->getMessage();
            $retorno->data = $pk;

            return $retorno;
        }


    }

    public function buscarTodosBase64($leads_pk){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $return =[];


        $sql ="";
        $sql.="select psl.pk, psl.dt_cadastro, psl.usuario_cadastro_pk, psl.dt_ult_atualizacao, psl.usuario_ult_atualizacao_pk ";
        $sql.="       ,c.ds_colaborador";
        $sql.="       ,c.pk colaborador_pk";
        $sql.="       ,c.empresas_pk";
        $sql.="       ,psl.ds_pin";
        $sql.="       ,psl.img_colaborador_cadastro";
        //$sql.="       ,psl.coordenadas";
        $sql.="  from ponto_solicitacao_liberacao_app psl ";
        $sql.="  inner join colaboradores c on psl.colaborador_pk = c.pk";
        $sql.="  left join usuarios u on psl.usuario_aprovacao_pk = u.pk";
        $sql.="  inner join agenda_colaborador_padrao a on a.colaboradores_pk = c.pk";
        $sql.="  inner join leads l on l.pk = a.leads_pk";
        $sql.=" where 1=1 ";
        $sql.=" and c.ic_status = 1 ";
        $sql.=" and psl.ic_status = 1 ";
        $sql.=' and psl.img_colaborador_cadastro !="" ';
        if($leads_pk!=""){
            $sql.=" and l.pk = ".$leads_pk;
        }
        $sql.=" order by psl.pk asc ";
       
   



        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            /* if(count($query)>0){
            for($i=0;$i<count($query);$i++){
                $return[] = array(
                    "pk" => $query[$i]["pk"],
                    "ds_colaborador" => $query[$i]["ds_colaborador"],
                    "colaborador_pk" => $query[$i]["colaborador_pk"],
                    "ds_pin" => $query[$i]["ds_pin"],
                    "img_colaborador_cadastro"=>'<img width="50" height="50" src="data:image/jpg;base64,'. ($query[$i]['img_colaborador_cadastro']).'">',
                );
            }
        }*/
        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }
}
