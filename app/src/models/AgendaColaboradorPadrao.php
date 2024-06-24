<?php
namespace App\Model;

use App\Utils\Util;
use GuzzleHttp\Client;

class AgendaColaboradorPadrao {

    public $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function excluir($pk){
        Util::execDelete('agenda_colaborador_padrao', ' pk='.$pk, $this->pdo);
    }
    public function salvar($agenda_colaborador_padrao){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $fields = array();
        $fields['leads_pk'] = $agenda_colaborador_padrao['leads_pk'];
        $fields['contratos_pk'] = $agenda_colaborador_padrao['contratos_pk'];
        $fields['dt_inicio_agenda'] = $agenda_colaborador_padrao['dt_inicio_agenda'];
        $fields['dt_fim_agenda'] = $agenda_colaborador_padrao['dt_fim_agenda'];
        $fields['produtos_servicos_pk'] = $agenda_colaborador_padrao['produtos_servicos_pk'];
        $fields['colaboradores_pk'] = $agenda_colaborador_padrao['colaboradores_pk'];
        $fields['processos_etapas_pk'] = $agenda_colaborador_padrao['processos_etapas_pk'];
        $fields['contratos_itens_pk'] = $agenda_colaborador_padrao['contratos_itens_pk'];
        $fields['turnos_pk'] = $agenda_colaborador_padrao['turnos_pk'];
        $fields['hr_inicio_expediente'] = $agenda_colaborador_padrao['hr_inicio_expediente'];
        $fields['hr_termino_expediente'] = $agenda_colaborador_padrao['hr_termino_expediente'];
        $fields['hr_saida_intervalo'] = $agenda_colaborador_padrao['hr_saida_intervalo'];
        $fields['hr_retorno_intervalo'] = $agenda_colaborador_padrao['hr_retorno_intervalo'];
        $fields['ic_folga_inverter'] = $agenda_colaborador_padrao['ic_folga_inverter'];
        $fields['tipo_escala'] = $agenda_colaborador_padrao['tipo_escala'];
        //$fields['ic_nao_repetir'] = $agenda_colaborador_padrao['ic_nao_repetir'];
        $fields['ic_preenchimento_automatico'] = $agenda_colaborador_padrao['ic_preenchimento_automatico'];
        $fields['ic_dom'] = $agenda_colaborador_padrao['ic_dom'];
        $fields['ic_seg'] = $agenda_colaborador_padrao['ic_seg'];
        $fields['ic_ter'] = $agenda_colaborador_padrao['ic_ter'];
        $fields['ic_qua'] = $agenda_colaborador_padrao['ic_qua'];
        $fields['ic_qui'] = $agenda_colaborador_padrao['ic_qui'];
        $fields['ic_sex'] = $agenda_colaborador_padrao['ic_sex'];
        $fields['ic_sab'] = $agenda_colaborador_padrao['ic_sab'];

        $fields['ic_dom_folga'] = $agenda_colaborador_padrao['ic_dom_folga'];
        $fields['ic_seg_folga'] = $agenda_colaborador_padrao['ic_seg_folga'];
        $fields['ic_ter_folga'] = $agenda_colaborador_padrao['ic_ter_folga'];
        $fields['ic_qua_folga'] = $agenda_colaborador_padrao['ic_qua_folga'];
        $fields['ic_qui_folga'] = $agenda_colaborador_padrao['ic_qui_folga'];
        $fields['ic_sex_folga'] = $agenda_colaborador_padrao['ic_sex_folga'];
        $fields['ic_sab_folga'] = $agenda_colaborador_padrao['ic_sab_folga'];

        $fields['dom_turnos_pk'] = $agenda_colaborador_padrao['dom_turnos_pk'];
        $fields['seg_turnos_pk'] = $agenda_colaborador_padrao['seg_turnos_pk'];
        $fields['ter_turnos_pk'] = $agenda_colaborador_padrao['ter_turnos_pk'];
        $fields['qua_turnos_pk'] = $agenda_colaborador_padrao['qua_turnos_pk'];
        $fields['qui_turnos_pk'] = $agenda_colaborador_padrao['qui_turnos_pk'];
        $fields['sex_turnos_pk'] = $agenda_colaborador_padrao['sex_turnos_pk'];
        $fields['sab_turnos_pk'] = $agenda_colaborador_padrao['sab_turnos_pk'];
        
        $fields['hr_turno_dom'] = $agenda_colaborador_padrao['hr_turno_dom'];
        $fields['hr_turno_seg'] = $agenda_colaborador_padrao['hr_turno_seg'];
        $fields['hr_turno_ter'] = $agenda_colaborador_padrao['hr_turno_ter'];
        $fields['hr_turno_qua'] = $agenda_colaborador_padrao['hr_turno_qua'];
        $fields['hr_turno_qui'] = $agenda_colaborador_padrao['hr_turno_qui'];
        $fields['hr_turno_sex'] = $agenda_colaborador_padrao['hr_turno_sex'];
        $fields['hr_turno_sab'] = $agenda_colaborador_padrao['hr_turno_sab'];
        $fields['hr_turno_dom_saida'] = $agenda_colaborador_padrao['hr_turno_dom_saida'];
        $fields['hr_turno_seg_saida'] = $agenda_colaborador_padrao['hr_turno_seg_saida'];
        $fields['hr_turno_ter_saida'] = $agenda_colaborador_padrao['hr_turno_ter_saida'];
        $fields['hr_turno_qua_saida'] = $agenda_colaborador_padrao['hr_turno_qua_saida'];
        $fields['hr_turno_qui_saida'] = $agenda_colaborador_padrao['hr_turno_qui_saida'];
        $fields['hr_turno_sex_saida'] = $agenda_colaborador_padrao['hr_turno_sex_saida'];
        $fields['hr_turno_sab_saida'] = $agenda_colaborador_padrao['hr_turno_sab_saida'];
        $fields['hr_intervalo_dom'] = $agenda_colaborador_padrao['hr_intervalo_dom'];
        $fields['hr_intervalo_seg'] = $agenda_colaborador_padrao['hr_intervalo_seg'];
        $fields['hr_intervalo_ter'] = $agenda_colaborador_padrao['hr_intervalo_ter'];
        $fields['hr_intervalo_qua'] = $agenda_colaborador_padrao['hr_intervalo_qua'];
        $fields['hr_intervalo_qui'] = $agenda_colaborador_padrao['hr_intervalo_qui'];
        $fields['hr_intervalo_sex'] = $agenda_colaborador_padrao['hr_intervalo_sex'];
        $fields['hr_intervalo_sab'] = $agenda_colaborador_padrao['hr_intervalo_sab'];
        $fields['hr_intervalo_saida_dom'] = $agenda_colaborador_padrao['hr_intervalo_saida_dom'];
        $fields['hr_intervalo_saida_seg'] = $agenda_colaborador_padrao['hr_intervalo_saida_seg'];
        $fields['hr_intervalo_saida_ter'] = $agenda_colaborador_padrao['hr_intervalo_saida_ter'];
        $fields['hr_intervalo_saida_qua'] = $agenda_colaborador_padrao['hr_intervalo_saida_qua'];
        $fields['hr_intervalo_saida_qui'] = $agenda_colaborador_padrao['hr_intervalo_saida_qui'];
        $fields['hr_intervalo_saida_sex'] = $agenda_colaborador_padrao['hr_intervalo_saida_sex'];
        $fields['hr_intervalo_saida_sab'] = $agenda_colaborador_padrao['hr_intervalo_saida_sab'];
        $fields['ds_motivo_cancelamento'] = $agenda_colaborador_padrao['ds_motivo_cancelamento'];
        $fields['ic_intrajornada'] = $agenda_colaborador_padrao['ic_intrajornada'];

        $fields['n_qtde_dias_semana'] = $agenda_colaborador_padrao['n_qtde_dias_semana'];

        if($agenda_colaborador_padrao['dt_cancelamento']!=""){
            $fields['dt_cancelamento'] = Util::DataYMD($agenda_colaborador_padrao['dt_cancelamento']);
        }


        $fields["dt_ult_atualizacao"] = "sysdate()";
        $fields["usuario_ult_atualizacao_pk"] = $_SESSION['session_user']['par1'];
       
        if($agenda_colaborador_padrao['pk']  == ""){
            
            $fields["dt_cadastro"] = "sysdate()";
            $fields["usuario_cadastro_pk"]   = $_SESSION['session_user']['par1'];


            $pk = Util::execInsert("agenda_colaborador_padrao", $fields,$this->pdo);
           
            $retorno->status = true;
            $retorno->message = 'Dados cadastrados com sucesso';
            $retorno->data = $pk;
        }
        else{
            Util::execUpdate("agenda_colaborador_padrao", $fields, " pk = ".$agenda_colaborador_padrao['pk'],$this->pdo);
            $pk = $agenda_colaborador_padrao['pk'];
            $retorno->status = true;
            $retorno->message = 'Dados atualizado com sucesso';
            $retorno->data = $pk;
        }
        return $retorno;
    }

    public function retornaEscalaColaboradorPeriodo($colaboradores_pk,$dt_periodo_ini,$dt_periodo_fim,$leads_pk,$agenda_colaborador_padrao_pk){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql="";
        $sql.="SELECT a.pk,";
        $sql.="        a.dt_inicio_agenda,";
        $sql.="        date_format(a.dt_inicio_agenda, '%m') mes_inicio_agenda,";
        $sql.="        date_format(a.dt_inicio_agenda, '%Y') ano_inicio_agenda,";
        $sql.="        a.dt_fim_agenda,";
        $sql.="        a.n_qtde_dias_semana,";
        $sql.="        a.tipo_escala,";
        $sql.="        a.ic_dom,";
        $sql.="        a.ic_seg,";
        $sql.="        a.ic_ter,";
        $sql.="        a.ic_qua,";
        $sql.="        a.ic_qui,";
        $sql.="        a.ic_sex,";
        $sql.="        a.ic_sab,";
        $sql.="        a.dom_turnos_pk,";
        $sql.="        a.seg_turnos_pk,";
        $sql.="        a.ter_turnos_pk,";
        $sql.="        a.qua_turnos_pk,";
        $sql.="        a.qui_turnos_pk,";
        $sql.="        a.sex_turnos_pk,";
        $sql.="        a.sab_turnos_pk,";
        $sql.="        a.turnos_pk,";
        $sql.="        a.ic_intrajornada,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom, '%H:%i') hr_turno_dom,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg, '%H:%i') hr_turno_seg,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter, '%H:%i') hr_turno_ter,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua, '%H:%i') hr_turno_qua,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui, '%H:%i') hr_turno_qui,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex, '%H:%i') hr_turno_sex,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab, '%H:%i') hr_turno_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_dom, '%H:%i') hr_intervalo_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_seg, '%H:%i') hr_intervalo_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_ter, '%H:%i') hr_intervalo_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qua, '%H:%i') hr_intervalo_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qui, '%H:%i') hr_intervalo_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sex, '%H:%i') hr_intervalo_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sab, '%H:%i') hr_intervalo_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_dom, '%H:%i') hr_intervalo_saida_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_seg, '%H:%i') hr_intervalo_saida_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_ter, '%H:%i') hr_intervalo_saida_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qua, '%H:%i') hr_intervalo_saida_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qui, '%H:%i') hr_intervalo_saida_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sex, '%H:%i') hr_intervalo_saida_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sab, '%H:%i') hr_intervalo_saida_sab,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom_saida, '%H:%i') hr_turno_dom_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg_saida, '%H:%i') hr_turno_seg_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter_saida, '%H:%i') hr_turno_ter_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua_saida, '%H:%i') hr_turno_qua_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui_saida, '%H:%i') hr_turno_qui_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex_saida, '%H:%i') hr_turno_sex_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab_saida, '%H:%i') hr_turno_sab_saida,";
        $sql.=" l.ds_lead,";
        $sql.=" cs.ic_preencher_folha";
        $sql.=" FROM agenda_colaborador_padrao a";
        $sql.=" left join leads l on a.leads_pk = l.pk";
        $sql.=" left join contratos c on a.contratos_pk = c.pk";
        $sql.=" left join contas cs on cs.pk = c.empresas_pk";
        $sql.=" WHERE a.colaboradores_pk =".$colaboradores_pk;

        if(!empty($agenda_colaborador_padrao_pk)){
            $sql.=" and a.pk =".$agenda_colaborador_padrao_pk;
        }
        $sql.="       AND '".Util::DataYMD($dt_periodo_ini)."' >= a.dt_inicio_agenda";
        $sql.="       AND '".Util::DataYMD($dt_periodo_fim)."' <= a.dt_fim_agenda";
        if(!empty($leads_pk)){
            $sql.="       AND a.leads_pk =".$leads_pk;
        }

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);



        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno->data;
    }

    public function retornarDifMes($dt_ini,$dt_fim){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $sql ="";
        $sql.="SELECT ROUND(TIMESTAMPDIFF(DAY, '".$dt_ini."', '".$dt_fim."')*12/365.24)mesdif";
        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);



        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno->data;
    }

    public function retornarEscalaImpar_Par($dt_periodo_ini,$v_mes_inicio_agenda,$v_ano_inicio_agenda,$dt_periodo_fim,$vtipoEscalaCadastro,$MesIniPeriodo){

        if($MesIniPeriodo <="9"){
            $MesForFolha =  str_replace("0","",$MesIniPeriodo );
        }else{
            $MesForFolha =  $MesIniPeriodo;
        }
        //Retorna se a escala do mes de consulta é par ou impar
        $queryMes = $this->retornarDifMes($dt_periodo_ini,$dt_periodo_fim);
        $qtde_mes = $queryMes[0]['mesdif']+1;
        $ds_escala = "";
        for ($b=0; $b < $qtde_mes; $b++){
            if($v_mes_inicio_agenda!='12'){
                //Escala de inicio
                if($b==0){
                    if($vtipoEscalaCadastro==1){
                        $vTipoMesFor = "impar";
                    }elseif($vtipoEscalaCadastro==2){
                        $vTipoMesFor = "par";
                    }
                    if($MesForFolha == $v_mes_inicio_agenda){
                        $ds_escala = $vtipoEscalaCadastro;
                        break;
                    }

                    $v_mes = $v_mes_inicio_agenda;
                }else{
                    if($v_mes_inicio_agenda == "01"){
                        $v_ultDiaMesAnterior = cal_days_in_month(CAL_GREGORIAN, 12,  $v_ano_inicio_agenda -1);
                    }else{
                        $v_ultDiaMesAnterior = cal_days_in_month(CAL_GREGORIAN, $v_mes_inicio_agenda -1 ,  $v_ano_inicio_agenda);
                    }
                    if($vTipoMesAnterior==''){
                        //echo "If<br>";
                        $vTipoMesAnterior = $vTipoMesFor;
                        if($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior<=30){
                            $v_tipoEscalaMesFor=2;
                            $vTipoMesAnterior = "par";
                        }elseif ($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior>30){
                            $v_tipoEscalaMesFor=1;
                            $vTipoMesAnterior = "impar";
                        }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior<=30){
                            $v_tipoEscalaMesFor=1;
                            $vTipoMesAnterior = "impar";
                        }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior>30){
                            $v_tipoEscalaMesFor=2;
                            $vTipoMesAnterior = "par";
                        }
                    }else{
                        //echo "else<br>";
                        if($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior<=30){
                            $v_tipoEscalaMesFor=2;
                            $vTipoMesAnterior = "par";
                        }elseif ($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior>30){
                            $v_tipoEscalaMesFor=1;
                            $vTipoMesAnterior = "impar";
                        }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior<=30){
                            $v_tipoEscalaMesFor=1;
                            $vTipoMesAnterior = "impar";
                        }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior>30){
                            $v_tipoEscalaMesFor=2;
                            $vTipoMesAnterior = "par";
                        }
                    }
                    if($MesForFolha == $v_mes_inicio_agenda){
                        $ds_escala = $v_tipoEscalaMesFor;
                        break;
                    }

                }
                //if($v_mes_inicio_agenda != $MesFimPeriodo){
                    $v_mes_inicio_agenda++;

                //}

            }else{
                if($b==0){
                    if($vtipoEscalaCadastro==1){
                        $vTipoMesFor = "impar";
                    }elseif($vtipoEscalaCadastro==2){
                        $vTipoMesFor = "par";
                    }
                    if($MesForFolha == $v_mes_inicio_agenda){
                        $ds_escala = $vtipoEscalaCadastro;
                        break;
                    }

                    $v_mes = $v_mes_inicio_agenda;
                }
                //$vtipoEscalaMesAtual = $vtipoEscalaMesAtual;

                //ultimo dia do mes anterior
                $v_ultDiaMesAnterior = cal_days_in_month(CAL_GREGORIAN, $v_mes_inicio_agenda -1,  $v_ano_inicio_agenda);


                //echo "else<br>";
                if($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior<=30){
                    $v_tipoEscalaMesFor=2;
                    $vTipoMesAnterior = "par";
                }elseif ($vTipoMesAnterior == "par" and $v_ultDiaMesAnterior>30){
                    $v_tipoEscalaMesFor=1;
                    $vTipoMesAnterior = "impar";
                }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior<=30){
                    $v_tipoEscalaMesFor=1;
                    $vTipoMesAnterior = "impar";
                }elseif ($vTipoMesAnterior == "impar" and $v_ultDiaMesAnterior>30){
                    $v_tipoEscalaMesFor=2;
                    $vTipoMesAnterior = "par";
                }


                if($MesForFolha == $v_mes_inicio_agenda){
                    $ds_escala = $v_tipoEscalaMesFor;
                    break;
                }
                $v_mes_inicio_agenda = '01';
                $v_ano_inicio_agenda = $v_ano_inicio_agenda +1;

            }
        }

        return $ds_escala;

    }
    public function escalaDadosColaborador($colaborador_pk, $dt_periodo_ini, $dt_periodo_fim, $ds_escala, $leads_pk, $agenda_colaborador_padrao_pk, $tipo_escala){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = true; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $retorno->message = ""; //Retorno data setado como vazio

        $queryDias = $this->retornarDifData(Util::DataYMD($dt_periodo_ini),Util::DataYMD($dt_periodo_fim));

        $qtdeDias = $queryDias[0]['dtdif'];
        $queryEscala = $this->retornaEscalaColaboradorPeriodo($colaborador_pk, $dt_periodo_ini, $dt_periodo_fim, $leads_pk, $agenda_colaborador_padrao_pk);

        $dtIni = (explode("/",$dt_periodo_ini));
        $diaIniPeriodo = $dtIni[0];
        $dia = $dtIni[0];
        $MesIniPeriodo = $dtIni[1];
        $AnoIniPeriodo = $dtIni[2];

        $dtFim = (explode("/",$dt_periodo_fim));
        $diaFimPeriodo = $dtFim[0];
        $MesFimPeriodo = $dtFim[1];
        $AnoFimPeriodo = $dtFim[2];



        for ($a=0; $a < $qtdeDias; $a++){
            $ic_escala ='';
            $dt_escala = $AnoIniPeriodo.'-'.$MesIniPeriodo.'-'.$dia;

            $ultimoDiaMes = cal_days_in_month(CAL_GREGORIAN, $MesFimPeriodo, $AnoFimPeriodo);

            if($ds_escala=='12x36'){
                $ic_dia ='';

                $dt_inicio_agenda = $queryEscala[0]['dt_inicio_agenda'];
                $v_mes_inicio_agenda = $queryEscala[0]['mes_inicio_agenda'];
                $v_ano_inicio_agenda = $queryEscala[0]['ano_inicio_agenda'];
                $dt_periodo_fim = $AnoFimPeriodo."-".$MesFimPeriodo."-".$ultimoDiaMes;
                $vtipoEscalaCadastro = $queryEscala[0]['tipo_escala'];

                //Calcula se a escala é ímpar ou par
                $ic_mes = $this->retornarEscalaImpar_Par($dt_inicio_agenda, $v_mes_inicio_agenda, $v_ano_inicio_agenda, $dt_periodo_fim, $vtipoEscalaCadastro, $MesIniPeriodo);
                if($dia % 2 == 0){
                    $ic_dia = 2;
                }else{
                    $ic_dia = 1;
                }


                if($ic_mes == $ic_dia){
                    $ic_escala = 1;
                }else{
                    $ic_escala = 2;
                }
            }else{

                $diasemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
                $diasemana_numero = date('w', strtotime($AnoIniPeriodo."-".$MesIniPeriodo."-".$dia));

                if($diasemana[$diasemana_numero]=="Dom"){
                    $ic_escala = $queryEscala[0]['ic_dom'];
                }elseif($diasemana[$diasemana_numero]=="Seg"){
                    $ic_escala = $queryEscala[0]['ic_seg'];
                }elseif($diasemana[$diasemana_numero]=="Ter"){
                    $ic_escala = $queryEscala[0]['ic_ter'];
                }elseif($diasemana[$diasemana_numero]=="Qua"){
                    $ic_escala = $queryEscala[0]['ic_qua'];
                }elseif($diasemana[$diasemana_numero]=="Qui"){
                    $ic_escala = $queryEscala[0]['ic_qui'];
                }elseif($diasemana[$diasemana_numero]=="Sex"){
                    $ic_escala = $queryEscala[0]['ic_sex'];
                }elseif($diasemana[$diasemana_numero]=="Sab"){
                    $ic_escala = $queryEscala[0]['ic_sab'];
                }
            }
            $fields = array();
            $fields["dt_cadastro"] = "sysdate()";
            $fields["usuario_cadastro_pk"] = $_SESSION['session_user']['par1'];
            $fields["dt_ult_atualizacao"]  = "sysdate()";
            $fields["usuario_ult_atualizacao_pk"] = $_SESSION['session_user']['par1'];
            $fields["dt_escala"] = $dt_escala;
            $fields["ic_escala"] = $ic_escala;
            $fields["tipo_escala_pk"] = $ds_escala;
            $fields["agenda_colaborador_padrao"] = $agenda_colaborador_padrao_pk;


            $pk = Util::execInsert("escala_dados_colaborador", $fields,$this->pdo);

            $ultimoDiaMesIni = cal_days_in_month(CAL_GREGORIAN, $MesIniPeriodo, $AnoIniPeriodo);

            if($ultimoDiaMesIni == $dia){
                if($MesIniPeriodo == '12'){
                    $AnoIniPeriodo =  $AnoIniPeriodo + 1;
                    $MesIniPeriodo = 1;
                }else{
                    $MesIniPeriodo++;
                }
                $dia = 1;
            }else{
                $dia++;
            }
        }
        return $retorno;
    }

    public function retornarDifData($dt_ini,$dt_fim){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $sql ="";
        $sql.="SELECT DATEDIFF('$dt_fim','$dt_ini')dtdif";

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $result;

        return $retorno->data;
    }


    public function listarQRCode($leads_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $result = array();
        $sql ="";
        $sql.="SELECT ";
        $sql.="        c.ds_pin, psl.ic_status, psl.ds_imagem,date_format(psl.dt_liberacao,'%d/%m/%Y')dt_liberacao";
        $sql.="        ,case psl.ic_status when '1' then 'Liberado' when 2 then 'Liberação Pendente' end ds_status";
        $sql.="        ,l.ds_lead";
        $sql.="        ,l.ds_tel";
        $sql.="        ,c.ds_colaborador";
        $sql.="        ,concat(l.ds_endereco,', ',l.ds_numero,' - ', l.ds_bairro,' - ', l.ds_cidade,' / ',l.ds_uf)ds_endereco";
        $sql.="     FROM";
        $sql.="        agenda_colaborador_padrao acp";
        $sql.="            INNER JOIN";
        $sql.="        processos_etapas pe ON acp.processos_etapas_pk = pe.pk";
        $sql.="            INNER JOIN";
        $sql.="        processos p ON pe.processos_pk = p.pk";
        $sql.="        inner join leads l on p.leads_pk = l.pk";
        $sql.="        inner join colaboradores c on acp.colaboradores_pk = c.pk ";
        $sql.="        left join ponto_solicitacao_liberacao_app psl on psl.colaborador_pk = c.pk";
        $sql.="        where 1=1 ";
        if($leads_pk!=""){
            $sql.="        and l.pk = ".$leads_pk;
        }
        $sql.="        and c.ic_status = 1";
        $sql.="        and acp.dt_cancelamento is null";
        $sql.=" group by c.ds_pin";

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        for($i = 0; $i < count($query); $i++){
            $ds_status = $query[$i]['ds_status'];
            if($query[$i]['ic_status']==""){
                $ds_status = "Liberação Não Solicitada";
            }

            $ds_imagem = $query[$i]['ds_imagem'];
            if($query[$i]['ds_imagem']==""){
                $ds_imagem = "" ;
            }

            $result[] = array(
                "ds_pin"=>$query[$i]['ds_pin'],
                "ds_imagem"=>$ds_imagem,
                "dt_liberacao"=>$query[$i]['dt_liberacao'],
                "ds_lead"=>$query[$i]['ds_lead'],
                "ds_tel"=>$query[$i]['ds_tel'],
                "ds_endereco"=>$query[$i]['ds_endereco'],
                "ds_colaborador"=>$query[$i]['ds_colaborador'],
                "ds_status"=>$ds_status
            );
        }

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $result;

        return $retorno;
    }

    public function lisarEscalaEditar($pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql ="";
        $sql.="SELECT a.pk,";
        $sql.=" l.pk leads_pk,";
        $sql.=" ct.pk contratos_pk,";
        $sql.=" date_format(a.dt_inicio_agenda, '%d/%m/%Y') dt_inicio_agenda,";
        $sql.=" date_format(a.dt_fim_agenda, '%d/%m/%Y') dt_fim_agenda,";
        $sql.=" date_format(a.dt_cancelamento, '%d/%m/%Y') dt_cancelamento,";
        $sql.=" a.ds_motivo_cancelamento,";
        $sql.=" ps.pk produtos_servicos_pk,";
        $sql.=" c.pk colaborador_pk,";
        $sql.=" a.turnos_pk,";
        $sql.=" TIME_FORMAT(a.hr_inicio_expediente, '%H:%i') hr_inicio_expediente,";
        $sql.=" TIME_FORMAT(a.hr_termino_expediente, '%H:%i') hr_termino_expediente,";
        $sql.=" TIME_FORMAT(a.hr_saida_intervalo, '%H:%i') hr_saida_intervalo,";
        $sql.=" TIME_FORMAT(a.hr_retorno_intervalo, '%H:%i') hr_retorno_intervalo,";
        $sql.=" a.ic_preenchimento_automatico,";
        $sql.=" a.ic_folga_inverter,";
        $sql.=" a.ic_intrajornada,";
        $sql.=" a.tipo_escala,";
        $sql.=" a.ic_dom_folga,";
        $sql.=" a.ic_seg_folga,";
        $sql.=" a.ic_ter_folga,";
        $sql.=" a.ic_qua_folga,";
        $sql.=" a.ic_qui_folga,";
        $sql.=" a.ic_sex_folga,";
        $sql.=" a.ic_sab_folga,";
        $sql.=" a.ic_dom,";
        $sql.=" a.ic_seg,";
        $sql.=" a.ic_ter,";
        $sql.=" a.ic_qua,";
        $sql.=" a.ic_qui,";
        $sql.=" a.ic_sex,";
        $sql.=" a.ic_sab,";
        $sql.=" a.dom_turnos_pk,";
        $sql.=" a.seg_turnos_pk,";
        $sql.=" a.ter_turnos_pk,";
        $sql.=" a.qua_turnos_pk,";
        $sql.=" a.qui_turnos_pk,";
        $sql.=" a.sex_turnos_pk,";
        $sql.=" a.sab_turnos_pk,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom, '%H:%i') hr_turno_dom,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg, '%H:%i') hr_turno_seg,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter, '%H:%i') hr_turno_ter,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua, '%H:%i') hr_turno_qua,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui, '%H:%i') hr_turno_qui,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex, '%H:%i') hr_turno_sex,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab, '%H:%i') hr_turno_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_dom, '%H:%i') hr_intervalo_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_seg, '%H:%i') hr_intervalo_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_ter, '%H:%i') hr_intervalo_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qua, '%H:%i') hr_intervalo_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qui, '%H:%i') hr_intervalo_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sex, '%H:%i') hr_intervalo_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sab, '%H:%i') hr_intervalo_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_dom, '%H:%i') hr_intervalo_saida_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_seg, '%H:%i') hr_intervalo_saida_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_ter, '%H:%i') hr_intervalo_saida_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qua, '%H:%i') hr_intervalo_saida_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qui, '%H:%i') hr_intervalo_saida_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sex, '%H:%i') hr_intervalo_saida_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sab, '%H:%i') hr_intervalo_saida_sab,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom_saida, '%H:%i') hr_turno_dom_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg_saida, '%H:%i') hr_turno_seg_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter_saida, '%H:%i') hr_turno_ter_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua_saida, '%H:%i') hr_turno_qua_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui_saida, '%H:%i') hr_turno_qui_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex_saida, '%H:%i') hr_turno_sex_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab_saida, '%H:%i') hr_turno_sab_saida";
        $sql.=" FROM agenda_colaborador_padrao a";
        $sql.=" INNER JOIN colaboradores c ON a.colaboradores_pk = c.pk";
        $sql.=" INNER JOIN colaboradores_produtos_servicos cps ON c.pk = cps.colaboradores_pk";
        $sql.=" INNER JOIN processos_etapas pe ON a.processos_etapas_pk = pe.pk";
        $sql.=" INNER JOIN processos p ON pe.processos_pk = p.pk";
        $sql.=" INNER JOIN leads l ON l.pk = p.leads_pk";
        $sql.=" INNER JOIN contratos_itens ci ON a.contratos_itens_pk = ci.pk";
        $sql.=" INNER JOIN contratos ct ON ci.contratos_pk = ct.pk";
        $sql.=" INNER JOIN produtos_servicos ps ON a.produtos_servicos_pk = ps.pk";
        $sql.=" WHERE   a.pk=".$pk;

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }
    public function consultarEscalaContratosItens($contratos_pk,$contratos_itens_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $result = array();
        $sql="";
        $sql.="SELECT";
        $sql.="         a.pk,";
        $sql.="         date_format(a.dt_inicio_agenda,'%d/%m/%Y') dt_inicio_agenda,";
        $sql.="         date_format(a.dt_fim_agenda,'%d/%m/%Y') dt_fim_agenda, ";
        $sql.="         c.ds_colaborador";
        $sql.="    FROM agenda_colaborador_padrao a";
        $sql.="         INNER JOIN  colaboradores c ON a.colaboradores_pk = c.pk";
        $sql.="    WHERE a.contratos_itens_pk = ".$contratos_itens_pk;
        //$sql.="         AND a.contratos_pk = ".$contratos_pk;
        $sql.="         AND a.dt_cancelamento IS NULL";
        $sql.="         AND a.dt_fim_agenda > sysdate()";


        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }
    public function listarTurno(){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql ="";
        $sql.="select pk ";
        $sql.="       ,ds_turno ";

        $sql.="  from turnos ";
        $sql.=" where 1=1 ";
        $sql.=" order by ds_turno asc ";


        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }
    public function  listarEscalasPostosColaborador($colaborador_pk, $dt_apontamento){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $result = array();
        $sql = "";
        $sql.= "select a.pk agenda_colaborador_padrao_pk";
        $sql.= "       ,a.colaboradores_pk";
        $sql.= "       ,l.ds_lead";
        $sql.= "       ,l.pk leads_pk";
        $sql.= "       ,a. n_qtde_dias_semana ds_escala";
        $sql.="        ,ps.pk produtos_servicos_pk";
        $sql.="        ,ps.ds_produto_servico ";
        $sql.= "  FROM agenda_colaborador_padrao a";
        $sql.= " INNER JOIN leads l ON a.leads_pk = l.pk";
        $sql.="  INNER JOIN colaboradores_produtos_servicos cps ON a.colaboradores_pk = cps.colaboradores_pk";
        $sql.="  INNER JOIN produtos_servicos ps ON cps.produtos_servicos_pk = ps.pk";
        $sql.= "  where 1=1";
        $sql.= "  and a.colaboradores_pk = ".$colaborador_pk;
        $sql.= "  and a.dt_inicio_agenda <= '".Util::DataYMD($dt_apontamento)."'";
        $sql.= "  and a.dt_fim_agenda >= '".Util::DataYMD($dt_apontamento)."'";
        $sql.="   and a.dt_cancelamento is null";


        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }
    public function  verificaOutraEscalaColaborador($colaboradores_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio
        $sql="";
        $sql.="SELECT a.pk,";
        $sql.=" l.pk leads_pk,";
        $sql.=" l.ds_lead,";
        $sql.=" c.ds_colaborador,";
        $sql.=" a.hr_inicio_expediente,";
        $sql.=" a.hr_termino_expediente,";
        $sql.=" date_format(a.dt_inicio_agenda, '%d/%m/%Y') dt_inicio_agenda,";
        $sql.=" date_format(a.dt_fim_agenda, '%d/%m/%Y') dt_fim_agenda,";
        $sql.=" date_format(a.dt_cancelamento, '%d/%m/%Y') dt_cancelamento";
        $sql.=" FROM agenda_colaborador_padrao a";
        $sql.="     INNER JOIN leads l ON a.leads_pk = l.pk";
        $sql.="     INNER JOIN colaboradores c ON a.colaboradores_pk = c.pk";
        $sql.=" WHERE a.colaboradores_pk =".$colaboradores_pk;
        $sql.="       AND a.dt_cancelamento IS NULL";
        $sql.="       AND a.dt_fim_agenda > sysdate()";

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $query;

        return $retorno;
    }

    public function calendarioDados($dt_ini,$dt_fim,$leads_pk,$colaborador_pk,$n_qtde_dias_semana,$tipo_escala_pk,$escala_pesq_agenda,$produtos_servicos_pk){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $pontodao = new Ponto($this->pdo);

        $dt_atual = date("Ymd");
        $dadosEscala = $this->calendarioDadosEscala($dt_fim,$leads_pk,$colaborador_pk,$n_qtde_dias_semana,$produtos_servicos_pk,0);

        $result = array();
        for($i=0; $i<count($dadosEscala->data);$i++){
            $DadosEscalaCalendario = array();
            $colaborador_pk = $dadosEscala->data[$i]['colaborador_pk'];
            if($dadosEscala->data[$i]['dt_cancelamento_agenda'] === NULL){
                $sql = "SELECT dt_escala, ic_escala, tipo_escala_pk, date_format(dt_escala, '%d') dia_mes, date_format(dt_escala, '%Y%m%d') ds_data";
                $sql .="    FROM escala_dados_colaborador";
                $sql .="   WHERE dt_escala BETWEEN '$dt_ini' AND '$dt_fim'";
                $sql .="   AND agenda_colaborador_padrao = ".$dadosEscala->data[$i]['pk'];
                $sql .="   order by dt_escala asc";


                $stmt = $this->pdo->prepare( $sql );
                $stmt->execute();
                $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);


                if(count($query) > 0){
                    for($j=0;$j<count($query);$j++){

                        $ds_background = "#d3d3d3";

                        if($query[$j]['tipo_escala_pk'] == "12X36"){
                            if($query[$j]['dt_escala'] % 2 == "0" && $query[$j]['ic_escala'] == 1){
                                $ds_escala = "Par";
                            }else{
                                $ds_escala = "Impar";
                            }
                        }else{
                            $ds_escala = " ";
                        }

                        if($query[$j]['ic_escala']==1){

                            $ds_tipo_escala = 'Escala';
                            $dt_escala = $query[$j]['dt_escala'];
                            $ds_data = $query[$j]['ds_data'];
                            $tipo_registro_ponto = "";
                            if($ds_data <= $dt_atual){

                                //query tabela ponto
                                $queryponto = $pontodao->verificarPontoAgenda($colaborador_pk, $dt_escala);
                                //query tabela apontamento
                                $queryapontamento = $pontodao->verificarApontamentoAgenda($colaborador_pk, $dt_escala);

                                if(count($queryapontamento->data) > 0){

                                    $tipo_apontamento_pk = $queryapontamento->data[0]['tipo_apontamento_pk'];
                                    $dt_apontamento = $queryapontamento->data[0]['dt_apontamento'];

                                    if($tipo_apontamento_pk != "" && $dt_apontamento != "" && $colaborador_pk != ""){
                                        $tipo_registro_ponto =  $tipo_apontamento_pk;
                                    }else{
                                        $tipo_registro_ponto =  "";
                                    }

                                    if($dt_apontamento != "" && $colaborador_pk != ""){
                                        $dt_registro =  $dt_apontamento;
                                    }else{
                                        $dt_registro = "";
                                    }

                                }else{

                                    if(count($queryponto->data) > 0){
                                        $tipo_ponto_pk = $queryponto->data[0]['tipo_ponto_pk'];
                                        $dt_hora_ponto = $queryponto->data[0]['dt_hora_ponto'];
                                        $colaborador_pk = $queryponto->data[0]['colaborador_pk'];

                                        if($tipo_ponto_pk != "" && $dt_hora_ponto != "" && $colaborador_pk != ""){
                                            $tipo_registro_ponto =  $tipo_ponto_pk;
                                        }else{
                                            $tipo_registro_ponto =  "";
                                        }

                                        if($dt_hora_ponto != "" && $colaborador_pk != ""){
                                            $dt_registro =  $dt_hora_ponto;
                                        }else{
                                            $dt_registro = "";
                                        }

                                    }
                                }
                                //informa o background
                                if ($tipo_registro_ponto == 1 && $dt_registro != ""){
                                    $ds_background = '#63ed83';
                                }else{
                                    $ds_background = '#FFFF73';
                                }
                            }

                            $DadosEscalaCalendario[] = array(
                                "ds_dia"=>$query[$j]['dia_mes'],
                                "ds_tipo_escala"=>$ds_tipo_escala,
                                "dt_escala"=>$query[$j]['dt_escala'],
                                "hr_ini"=>$dadosEscala->data[$i]['hr_inicio_expediente'],
                                "hr_fim"=>$dadosEscala->data[$i]['hr_termino_expediente'],
                                "tipo_escala_pk"=>$query[$j]['tipo_escala_pk'],
                                "tipo_registro_ponto"=> $tipo_registro_ponto,
                                "ds_background"=> $ds_background,
                                "ds_escala"=> $ds_escala,
                                "dt_atual"=> $dt_atual
                            );

                        }
                    }
                }else{
                    //echo $i;
                    $DadosEscalaCalendario[] = array(
                        "ds_dia"=>" ",
                        "ds_tipo_escala"=>" ",
                        "dt_escala"=>" ",
                        "hr_ini"=>" ",
                        "hr_fim"=>" ",
                        "tipo_escala_pk"=> " ",
                        "tipo_registro_ponto"=> " ",
                        "ds_background"=> " ",
                        "dt_atual"=> " ",
                        "ds_escala"=> " "
                    );
                }

                foreach($DadosEscalaCalendario as $dCalendario){

                    $result[] = array(
                        "id"=>$dadosEscala->data[$i]['pk'],
                        "resourceId"=>$dadosEscala->data[$i]['colaborador_pk'],
                        "start"=>$dCalendario['dt_escala']."T".$dCalendario['hr_ini'],
                        "end"=>$dCalendario['dt_escala']."T".$dCalendario['hr_fim'],
                        "textColor" => "#000000",
                        'title'=> 'Escala',
                        "color"=>$dCalendario['ds_background'],
                        "agenda_colaborador_padrao_pk"=>$dadosEscala->data[$i]['pk'],
                        "ds_lead"=>$dadosEscala->data[$i]['ds_lead'],
                        "leads_pk"=>$dadosEscala->data[$i]['leads_pk'],
                        "ds_colaborador"=>$dadosEscala->data[$i]['ds_colaborador'],
                        "colaborador_pk"=>$dadosEscala->data[$i]['colaborador_pk'],
                        "ds_produto_servico"=>$dadosEscala->data[$i]['ds_produto_servico'],
                        "produtos_servicos_pk"=>$dadosEscala->data[$i]['produtos_servicos_pk'],
                        "tipo_escala_pk"=>$dadosEscala->data[$i]['tipo_escala_pk'],
                        "ds_tipo_escala"=>$dCalendario['ds_escala'],
                        "dt_cancelamento_agenda"=>$dadosEscala->data[$i]['dt_cancelamento_agenda'],
                        "ic_status"=>$dadosEscala->data[$i]['ic_status']

                    );
                }

            }else{
                $result[] = array(
                    "agenda_colaborador_padrao_pk"=>"",
                    "ds_lead"=>"",
                    "leads_pk"=>"",
                    "ds_colaborador"=>"",
                    "colaborador_pk"=>"",
                    "ds_produto_servico"=>"",
                    "produtos_servicos_pk"=>"",
                    "n_qtde_dias_semana"=>"",
                    "tipo_escala_pk"=>"",
                    "ds_tipo_escala"=>"",
                    "dt_cancelamento_agenda"=>"",
                    "ic_status"=>"",
                    "DadosEscalaCalendario"=>""
                );
            }
        }


        echo json_encode($result);
        exit(0);

        //$dataRequest.='{"resourceIds":"'.$v[$i]['STATUS'].'","color":"'.$color.'","id":"'.$v[$i]['ID'].'","description":"'.$v[$i]['DESCRICAO'].'","title":"'.$v[$i]['TITLE'].'","start":"'.$v[$i]['DATA_HORA'].'","categoryname":"'.$v[$i]['PROCEDIMENTO'].'","groupId":"'.trim($v[$i]['ESPECIALISTA']).'","categoryanimal":"'.$v[$i]['ESPECIE'].' - '.$v[$i]['NOME_ANIMAL'].'"},';
    }

    public function calendarioDadosEscala($dt_fim,$leads_pk,$colaborador_pk,$n_qtde_dias_semana,$produtos_servicos_pk,$resource){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql="";
        $sql.="SELECT DISTINCT(a.pk)pk,";
        $sql.="       l.ds_lead,";
        $sql.="       l.pk leads_pk,";
        $sql.="       c.ds_colaborador,";
        $sql.="       c.pk colaborador_pk,";
        $sql.="       c.ds_colaborador,";
        $sql.="       ps.pk produtos_servicos_pk,";
        $sql.="       ps.ds_produto_servico,";
        $sql.="       ci.n_qtde_dias_semana,";
        $sql.="       a.tipo_escala tipo_escala_pk,";
        $sql.="       case WHEN a.tipo_escala=1 THEN ";
        $sql.="         'PAR' ";
        $sql.="       WHEN a.tipo_escala=2 THEN ";
        $sql.="         'IMPAR' ";
        $sql.="       ELSE ''  ";
        $sql.="       END ds_tipo_escala,";
        $sql.="       a.dt_cancelamento dt_cancelamento_agenda,";
        $sql.="       c.ic_status,";
        $sql.="       a.turnos_pk,";
        $sql.="       a.hr_inicio_expediente,";
        $sql.="       a.hr_termino_expediente,";
        $sql.="       a.hr_saida_intervalo,";
        $sql.="       a.hr_retorno_intervalo,";
        $sql.="       a.dt_inicio_agenda,";
        $sql.="       a.dt_cancelamento";
        $sql.=" FROM agenda_colaborador_padrao a";
        $sql.="     INNER JOIN leads l ON a.leads_pk = l.pk";
        $sql.="     INNER JOIN colaboradores c ON a.colaboradores_pk = c.pk";
        $sql.="     INNER JOIN colaboradores_produtos_servicos cps ON c.pk = cps.colaboradores_pk";
        $sql.="     INNER JOIN produtos_servicos ps ON cps.produtos_servicos_pk = ps.pk";
        $sql.="     INNER JOIN contratos_itens ci ON a.contratos_itens_pk = ci.pk";
        $sql.="     INNER JOIN contratos ct ON ci.contratos_pk = ct.pk";

        $sql.=" WHERE 1=1";
        if($dt_fim!=""){
            $sql.=" AND a.dt_fim_agenda >= '".($dt_fim)."'";
        }

        if($leads_pk!=""){
            $sql.=" AND l.pk=".$leads_pk;
        }

        if($colaborador_pk!=""){
            $sql.=" AND c.pk=".$colaborador_pk;
        }
        if($n_qtde_dias_semana!=""){
            $sql.=" AND ci.n_qtde_dias_semana='".$n_qtde_dias_semana."'";
        }

        if($produtos_servicos_pk!=""){
            $sql.=" AND ps.pk=".$produtos_servicos_pk;
        }

        $sql.=" AND a.dt_cancelamento is null";
        $sql.=" Group by l.ds_lead, a.colaboradores_pk,  a.pk";
        $sql.=" order by l.ds_lead, c.ds_colaborador";



        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        if($resource==1){
            $result = array();
            foreach($query as $v){
                $result[] = array(
                    "id"=>$v['colaborador_pk'],
                    "posto_trabalho"=>$v['ds_lead'],
                    "colaborador"=>$v['ds_colaborador'],
                    "qualificacao"=>$v['ds_produto_servico'],
                    "escala"=>$v['n_qtde_dias_semana'],
                    "tipo_escala"=>$v['ds_tipo_escala'],
                    "leads_pk"=>$v['leads_pk'],
                    "colaborador_pk"=>$v['colaborador_pk']
                );
            }

            echo json_encode($result);
            exit(0);
        }
        else{
            $retorno->status = true;
            $retorno->message = 'Dados carregados com sucesso';
            $retorno->data = $query;
            return $retorno;
        }

    }

    public function listarEscalasResPadrao($leads_pk,$processos_pk,$colaborador_pk,$leads_pk_pesq,$colaborador_pk_pesq_agenda,$escala_pesq_agenda,$tipo_escala_pesq_agenda,$produtos_pesq_agenda,$ic_status_pesq_agenda,$turno_base_pk_pesq){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

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
        $search = "";
        if (isset($_GET['search']['value']) and $_GET['search']['value'] != '') {
            $pesq = $_GET['search']['value'];
            $search .= " AND (
                            a.pk LIKE '%".$pesq."%' OR
                            t.ds_turno LIKE '%".$pesq."%' OR
                            c.ds_colaborador LIKE '%".$pesq."%' OR
                            c.ds_pin LIKE '%".$pesq."%' OR
                            ps.ds_produto_servico LIKE '%".$pesq."%' OR
                            a.n_qtde_dias_semana LIKE '%".$pesq."%' OR
                            l.ds_lead LIKE '%".$pesq."%' 
                        )";
        }

        $sql ="";
        $sql.=" SELECT DISTINCT(a.pk) pk,";
        $sql.=" l.ds_lead,";
        $sql.=" l.pk leads_pk,";
        $sql.=" c.ds_colaborador,";
        $sql.=" c.ds_pin,";
        $sql.=" ps.ds_produto_servico,";
        $sql.=" l.pk leads_pk,";
        $sql.=" ct.pk contratos_pk,";
        $sql.=" date_format(a.dt_inicio_agenda, '%d/%m/%Y') dt_inicio_agenda,";
        $sql.=" date_format(a.dt_fim_agenda, '%d/%m/%Y') dt_fim_agenda,";
        $sql.=" date_format(a.dt_cancelamento, '%d/%m/%Y') dt_cancelamento,";
        $sql.=" a.ds_motivo_cancelamento,";
        $sql.=" ps.pk produtos_servicos_pk,";
        $sql.=" c.pk colaborador_pk,";
        $sql.=" a.turnos_pk,";
        $sql.=" a.contratos_itens_pk,";
        $sql.=" TIME_FORMAT(a.hr_inicio_expediente, '%H:%i') hr_inicio_expediente,";
        $sql.=" TIME_FORMAT(a.hr_termino_expediente, '%H:%i') hr_termino_expediente,";
        $sql.=" TIME_FORMAT(a.hr_saida_intervalo, '%H:%i') hr_saida_intervalo,";
        $sql.=" TIME_FORMAT(a.hr_retorno_intervalo, '%H:%i') hr_retorno_intervalo,";
        $sql.=" a.ic_preenchimento_automatico,";
        $sql.=" a.processos_etapas_pk,";
        $sql.=" a.ic_folga_inverter,";
        $sql.=" a.ic_intrajornada,";
        $sql.=" a.tipo_escala,";
        $sql.=" a.ic_dom_folga,";
        $sql.=" a.ic_seg_folga,";
        $sql.=" a.n_qtde_dias_semana,";
        $sql.=" p.pk processos_pk,";
        $sql.=" ps.pk produtos_pk ,";
        $sql.=" ct.ds_identificacao_area ,";

        $sql.=" a.ic_ter_folga,";
        $sql.=" a.ic_qua_folga,";
        $sql.=" a.ic_qui_folga,";
        $sql.=" a.ic_sex_folga,";
        $sql.=" a.ic_sab_folga,";
        $sql.=" a.ic_dom,";
        $sql.=" a.ic_seg,";
        $sql.=" a.ic_ter,";
        $sql.=" a.ic_qua,";
        $sql.=" a.ic_qui,";
        $sql.=" a.ic_sex,";
        $sql.=" a.ic_sab,";
        $sql.=" a.dom_turnos_pk,";
        $sql.=" a.seg_turnos_pk,";
        $sql.=" a.ter_turnos_pk,";
        $sql.=" a.qua_turnos_pk,";
        $sql.=" a.qui_turnos_pk,";
        $sql.=" a.sex_turnos_pk,";
        $sql.=" a.sab_turnos_pk,";
        $sql.=" a.ic_nao_repetir,";
        $sql.=" t.ds_turno,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom, '%H:%i') hr_turno_dom,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg, '%H:%i') hr_turno_seg,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter, '%H:%i') hr_turno_ter,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua, '%H:%i') hr_turno_qua,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui, '%H:%i') hr_turno_qui,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex, '%H:%i') hr_turno_sex,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab, '%H:%i') hr_turno_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_dom, '%H:%i') hr_intervalo_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_seg, '%H:%i') hr_intervalo_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_ter, '%H:%i') hr_intervalo_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qua, '%H:%i') hr_intervalo_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_qui, '%H:%i') hr_intervalo_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sex, '%H:%i') hr_intervalo_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_sab, '%H:%i') hr_intervalo_sab,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_dom, '%H:%i') hr_intervalo_saida_dom,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_seg, '%H:%i') hr_intervalo_saida_seg,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_ter, '%H:%i') hr_intervalo_saida_ter,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qua, '%H:%i') hr_intervalo_saida_qua,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qui, '%H:%i') hr_intervalo_saida_qui,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sex, '%H:%i') hr_intervalo_saida_sex,";
        $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sab, '%H:%i') hr_intervalo_saida_sab,";
        $sql.=" TIME_FORMAT(a.hr_turno_dom_saida, '%H:%i') hr_turno_dom_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_seg_saida, '%H:%i') hr_turno_seg_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_ter_saida, '%H:%i') hr_turno_ter_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qua_saida, '%H:%i') hr_turno_qua_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_qui_saida, '%H:%i') hr_turno_qui_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sex_saida, '%H:%i') hr_turno_sex_saida,";
        $sql.=" TIME_FORMAT(a.hr_turno_sab_saida, '%H:%i') hr_turno_sab_saida";
        $sql.=" FROM agenda_colaborador_padrao a";
        $sql.=" INNER JOIN colaboradores c ON a.colaboradores_pk = c.pk";
        $sql.=" LEFT JOIN turnos t ON a.turnos_pk = t.pk";
        $sql.=" INNER JOIN colaboradores_produtos_servicos cps ON c.pk = cps.colaboradores_pk";
        $sql.=" INNER JOIN processos_etapas pe ON a.processos_etapas_pk = pe.pk";
        $sql.=" INNER JOIN processos p ON pe.processos_pk = p.pk";
        $sql.=" INNER JOIN leads l ON l.pk = p.leads_pk";
        $sql.=" INNER JOIN contratos_itens ci ON a.contratos_itens_pk = ci.pk";
        $sql.=" INNER JOIN contratos ct ON ci.contratos_pk = ct.pk";
        $sql.=" INNER JOIN produtos_servicos ps ON a.produtos_servicos_pk = ps.pk";
        $sql.=" WHERE     1 = 1 ";
        $sql.=$search;

        if($leads_pk!=""){
            $sql.=" and p.leads_pk=".$leads_pk;
        }
        if($leads_pk_pesq!=""){
            $sql.=" and p.leads_pk=".$leads_pk_pesq;
        }

        if(!empty($turno_base_pk_pesq)){
            $sql.=" and a.turnos_pk ='".$turno_base_pk_pesq."'";
        }

        if($escala_pesq_agenda!=""){
            $sql.=" and ci.n_qtde_dias_semana='".$escala_pesq_agenda."'";
        }
        if($tipo_escala_pesq_agenda!=""){
            $sql.=" and a.tipo_escala=".$tipo_escala_pesq_agenda;
        }
        if($produtos_pesq_agenda!=""){
            $sql.=" and ps.pk =".$produtos_pesq_agenda;
        }
        if($ic_status_pesq_agenda!=""){
            if($ic_status_pesq_agenda==1){
                $sql.=" and a.dt_cancelamento is null";
            }
            if($ic_status_pesq_agenda==2){
                $sql.=" and a.dt_cancelamento is not null";
            }
        }
        if($processos_pk!=""){
            $sql.=" and p.pk=".$processos_pk;
        }
        if($colaborador_pk_pesq_agenda!=""){
            $sql.=" and a.colaboradores_pk=".$colaborador_pk_pesq_agenda;
        }
        if($colaborador_pk!=""){
            $sql.=" and a.colaboradores_pk=".$colaborador_pk;
        }
        $sql.=" group by a.pk ";
        $sql.=" order by a.dt_inicio_agenda asc ";


        $stmt = $this->pdo->prepare( $sql.$lengthSql );
        $stmt->execute();
        $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $mysql_data = [];
        if(count($query) > 0){
            for($i = 0; $i < count($query); $i++){

                $mysql_data[] = array(
                    "t_pk" => $query[$i]["pk"],
                    "t_ds_lead" => $query[$i]["ds_lead"],
                    "t_ds_colaborador" => $query[$i]["ds_colaborador"],
                    "t_ds_pin" => $query[$i]["ds_pin"],
                    "t_ds_produto_servico" => $query[$i]["ds_produto_servico"],
                    "t_ds_turno" => $query[$i]["ds_turno"],
                    "t_dt_periodo_escala" => $query[$i]["dt_inicio_agenda"]." Atê ".$query[$i]["dt_fim_agenda"],
                    "t_dt_cancelamento" => $query[$i]["dt_cancelamento"],
                    "t_ds_motivo_cancelamento" => $query[$i]["ds_motivo_cancelamento"],
                    "t_leads_pk" => $query[$i]["leads_pk"],
                    "t_processos_pk" => $query[$i]["processos_pk"],
                    "t_colaborador_pk" => $query[$i]["colaborador_pk"],
                    "t_contratos_pk" => $query[$i]["contratos_pk"],
                    "t_dt_inicio_agenda" => $query[$i]["dt_inicio_agenda"],
                    "t_dt_fim_agenda" => $query[$i]["dt_fim_agenda"],
                    "t_produtos_pk" => $query[$i]["produtos_pk"],
                    "t_ds_identificacao_area" => $query[$i]["ds_identificacao_area"],
                    "t_n_qtde_dias_semana" => $query[$i]["n_qtde_dias_semana"],

                );
            }
        }


        $stmtCount = $this->pdo->prepare( $sql );
        $stmtCount->execute();
        $rowsCount = $stmtCount->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $mysql_data;
        $retorno->iTotalDisplayRecords = count($rowsCount);
        $retorno->iTotalRecords = count($rowsCount);

        echo json_encode($retorno);
        exit(0);
    }
    public function lisarEscalasResPadraoColaborador($colaborador_pk){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        if($colaborador_pk!=""){
            $sql ="";
            $sql.=" SELECT DISTINCT(a.pk) pk,";
            $sql.=" l.ds_lead,";
            $sql.=" l.pk leads_pk,";
            $sql.=" c.ds_colaborador,";
            $sql.=" ps.ds_produto_servico,";
            $sql.=" l.pk leads_pk,";
            $sql.=" ct.pk contratos_pk,";
            $sql.=" date_format(a.dt_inicio_agenda, '%d/%m/%Y') dt_inicio_agenda,";
            $sql.=" date_format(a.dt_fim_agenda, '%d/%m/%Y') dt_fim_agenda,";
            $sql.=" date_format(a.dt_cancelamento, '%d/%m/%Y') dt_cancelamento,";
            $sql.=" a.ds_motivo_cancelamento,";
            $sql.=" ps.pk produtos_servicos_pk,";
            $sql.=" c.pk colaborador_pk,";
            $sql.=" a.turnos_pk,";
            $sql.=" a.contratos_itens_pk,";
            $sql.=" TIME_FORMAT(a.hr_inicio_expediente, '%H:%i') hr_inicio_expediente,";
            $sql.=" TIME_FORMAT(a.hr_termino_expediente, '%H:%i') hr_termino_expediente,";
            $sql.=" TIME_FORMAT(a.hr_saida_intervalo, '%H:%i') hr_saida_intervalo,";
            $sql.=" TIME_FORMAT(a.hr_retorno_intervalo, '%H:%i') hr_retorno_intervalo,";
            $sql.=" a.ic_preenchimento_automatico,";
            $sql.=" a.processos_etapas_pk,";
            $sql.=" a.ic_folga_inverter,";
            $sql.=" a.ic_intrajornada,";
            $sql.=" a.tipo_escala,";
            $sql.=" a.ic_dom_folga,";
            $sql.=" a.ic_seg_folga,";
            $sql.=" a. n_qtde_dias_semana,";
            $sql.=" p.pk processos_pk,";
            $sql.=" ps.pk produtos_pk ,";
            $sql.=" ct.ds_identificacao_area ,";

            $sql.=" a.ic_ter_folga,";
            $sql.=" a.ic_qua_folga,";
            $sql.=" a.ic_qui_folga,";
            $sql.=" a.ic_sex_folga,";
            $sql.=" a.ic_sab_folga,";
            $sql.=" a.ic_dom,";
            $sql.=" a.ic_seg,";
            $sql.=" a.ic_ter,";
            $sql.=" a.ic_qua,";
            $sql.=" a.ic_qui,";
            $sql.=" a.ic_sex,";
            $sql.=" a.ic_sab,";
            $sql.=" a.dom_turnos_pk,";
            $sql.=" a.seg_turnos_pk,";
            $sql.=" a.ter_turnos_pk,";
            $sql.=" a.qua_turnos_pk,";
            $sql.=" a.qui_turnos_pk,";
            $sql.=" a.sex_turnos_pk,";
            $sql.=" a.sab_turnos_pk,";
            $sql.=" a.ic_nao_repetir,";
            $sql.=" t.ds_turno,";
            $sql.=" TIME_FORMAT(a.hr_turno_dom, '%H:%i') hr_turno_dom,";
            $sql.=" TIME_FORMAT(a.hr_turno_seg, '%H:%i') hr_turno_seg,";
            $sql.=" TIME_FORMAT(a.hr_turno_ter, '%H:%i') hr_turno_ter,";
            $sql.=" TIME_FORMAT(a.hr_turno_qua, '%H:%i') hr_turno_qua,";
            $sql.=" TIME_FORMAT(a.hr_turno_qui, '%H:%i') hr_turno_qui,";
            $sql.=" TIME_FORMAT(a.hr_turno_sex, '%H:%i') hr_turno_sex,";
            $sql.=" TIME_FORMAT(a.hr_turno_sab, '%H:%i') hr_turno_sab,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_dom, '%H:%i') hr_intervalo_dom,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_seg, '%H:%i') hr_intervalo_seg,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_ter, '%H:%i') hr_intervalo_ter,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_qua, '%H:%i') hr_intervalo_qua,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_qui, '%H:%i') hr_intervalo_qui,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_sex, '%H:%i') hr_intervalo_sex,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_sab, '%H:%i') hr_intervalo_sab,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_dom, '%H:%i') hr_intervalo_saida_dom,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_seg, '%H:%i') hr_intervalo_saida_seg,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_ter, '%H:%i') hr_intervalo_saida_ter,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qua, '%H:%i') hr_intervalo_saida_qua,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_qui, '%H:%i') hr_intervalo_saida_qui,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sex, '%H:%i') hr_intervalo_saida_sex,";
            $sql.=" TIME_FORMAT(a.hr_intervalo_saida_sab, '%H:%i') hr_intervalo_saida_sab,";
            $sql.=" TIME_FORMAT(a.hr_turno_dom_saida, '%H:%i') hr_turno_dom_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_seg_saida, '%H:%i') hr_turno_seg_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_ter_saida, '%H:%i') hr_turno_ter_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_qua_saida, '%H:%i') hr_turno_qua_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_qui_saida, '%H:%i') hr_turno_qui_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_sex_saida, '%H:%i') hr_turno_sex_saida,";
            $sql.=" TIME_FORMAT(a.hr_turno_sab_saida, '%H:%i') hr_turno_sab_saida";
            $sql.=" FROM agenda_colaborador_padrao a";
            $sql.=" INNER JOIN colaboradores c ON a.colaboradores_pk = c.pk";
            $sql.=" LEFT JOIN turnos t ON a.turnos_pk = t.pk";
            $sql.=" INNER JOIN colaboradores_produtos_servicos cps ON c.pk = cps.colaboradores_pk";
            $sql.=" INNER JOIN processos_etapas pe ON a.processos_etapas_pk = pe.pk";
            $sql.=" INNER JOIN processos p ON pe.processos_pk = p.pk";
            $sql.=" INNER JOIN leads l ON l.pk = p.leads_pk";
            $sql.=" INNER JOIN contratos_itens ci ON a.contratos_itens_pk = ci.pk";
            $sql.=" INNER JOIN contratos ct ON ci.contratos_pk = ct.pk";
            $sql.=" INNER JOIN produtos_servicos ps ON a.produtos_servicos_pk = ps.pk";
            $sql.=" WHERE     1 = 1";
            $sql.=" and a.colaboradores_pk=".$colaborador_pk;

            $sql.=" group by a.pk ";
            $sql.=" order by a.dt_inicio_agenda asc ";

            $stmt = $this->pdo->prepare( $sql );
            $stmt->execute();
            $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $mysql_data = [];
            if(count($query) > 0){
                for($i = 0; $i < count($query); $i++){

                    $mysql_data[] = array(
                        "t_pk" => $query[$i]["pk"],
                        "t_ds_lead" => $query[$i]["ds_lead"],
                        "t_ds_colaborador" => $query[$i]["ds_colaborador"],
                        "t_ds_produto_servico" => $query[$i]["ds_produto_servico"],
                        "t_n_qtde_dias_semana" => $query[$i]["n_qtde_dias_semana"],
                        "t_dt_periodo_escala" => $query[$i]["dt_inicio_agenda"]." Atê ".$query[$i]["dt_fim_agenda"],
                        "t_dt_cancelamento" => $query[$i]["dt_cancelamento"],
                        "t_ds_motivo_cancelamento" => $query[$i]["ds_motivo_cancelamento"],
                        "t_leads_pk" => $query[$i]["leads_pk"],
                        "t_processos_pk" => $query[$i]["processos_pk"],
                        "t_contratos_pk" => $query[$i]["contratos_pk"],
                        "t_dt_inicio_agenda" => $query[$i]["dt_inicio_agenda"],
                        "t_dt_fim_agenda" => $query[$i]["dt_fim_agenda"],
                        "t_produtos_pk" => $query[$i]["produtos_pk"],
                        "t_ds_identificacao_area" => $query[$i]["ds_identificacao_area"],

                        "t_ic_nao_repetir"=>$query[$i]['ic_nao_repetir'],
                        "t_contratos_itens_pk" => $query[$i]["contratos_itens_pk"],
                        "t_processos_etapas_pk"=>$query[$i]['processos_etapas_pk'],
                        "t_produtos_servicos_pk" => $query[$i]["produtos_servicos_pk"],
                        "t_colaborador_pk" => $query[$i]["colaborador_pk"],
                        "t_turnos_pk" => $query[$i]["turnos_pk"],
                        "t_hr_inicio_expediente" => $query[$i]["hr_inicio_expediente"],
                        "t_hr_termino_expediente" => $query[$i]["hr_termino_expediente"],
                        "t_hr_saida_intervalo" => $query[$i]["hr_saida_intervalo"],
                        "t_hr_retorno_intervalo" => $query[$i]["hr_retorno_intervalo"],
                        "t_ic_preenchimento_automatico" => $query[$i]["ic_preenchimento_automatico"],
                        "t_ic_folga_inverter" => $query[$i]["ic_folga_inverter"],
                        "t_tipo_escala" => $query[$i]["tipo_escala"],
                        "t_ic_dom_folga" => $query[$i]["ic_dom_folga"],
                        "t_ic_seg_folga" => $query[$i]["ic_seg_folga"],
                        "t_ic_ter_folga" => $query[$i]["ic_ter_folga"],
                        "t_ic_qua_folga" => $query[$i]["ic_qua_folga"],
                        "t_ic_qui_folga" => $query[$i]["ic_qui_folga"],
                        "t_ic_sex_folga" => $query[$i]["ic_sex_folga"],
                        "t_ic_sab_folga" => $query[$i]["ic_sab_folga"],
                        "t_ic_dom" => $query[$i]["ic_dom"],
                        "t_ic_seg" => $query[$i]["ic_seg"],
                        "t_ic_ter" => $query[$i]["ic_ter"],
                        "t_ic_qua" => $query[$i]["ic_qua"],
                        "t_ic_qui" => $query[$i]["ic_qui"],
                        "t_ic_sex" => $query[$i]["ic_sex"],
                        "t_ic_sab" => $query[$i]["ic_sab"],
                        "t_dom_turnos_pk" => $query[$i]["dom_turnos_pk"],
                        "t_seg_turnos_pk" => $query[$i]["seg_turnos_pk"],
                        "t_ter_turnos_pk" => $query[$i]["ter_turnos_pk"],
                        "t_qua_turnos_pk" => $query[$i]["qua_turnos_pk"],
                        "t_qui_turnos_pk" => $query[$i]["qui_turnos_pk"],
                        "t_sex_turnos_pk" => $query[$i]["sex_turnos_pk"],
                        "t_sab_turnos_pk" => $query[$i]["sab_turnos_pk"],
                        "t_hr_turno_dom" => $query[$i]["hr_turno_dom"],
                        "t_hr_turno_seg" => $query[$i]["hr_turno_seg"],
                        "t_hr_turno_ter" => $query[$i]["hr_turno_ter"],
                        "t_hr_turno_qua" => $query[$i]["hr_turno_qua"],
                        "t_hr_turno_qui" => $query[$i]["hr_turno_qui"],
                        "t_hr_turno_sex" => $query[$i]["hr_turno_sex"],
                        "t_hr_turno_sab" => $query[$i]["hr_turno_sab"],
                        "t_hr_intervalo_dom" => $query[$i]["hr_intervalo_dom"],
                        "t_hr_intervalo_seg" => $query[$i]["hr_intervalo_seg"],
                        "t_hr_intervalo_ter" => $query[$i]["hr_intervalo_ter"],
                        "t_hr_intervalo_qua" => $query[$i]["hr_intervalo_qua"],
                        "t_hr_intervalo_qui" => $query[$i]["hr_intervalo_qui"],
                        "t_hr_intervalo_sex" => $query[$i]["hr_intervalo_sex"],
                        "t_hr_intervalo_sab" => $query[$i]["hr_intervalo_sab"],
                        "t_hr_intervalo_saida_dom" => $query[$i]["hr_intervalo_saida_dom"],
                        "t_hr_intervalo_saida_seg" => $query[$i]["hr_intervalo_saida_seg"],
                        "t_hr_intervalo_saida_ter" => $query[$i]["hr_intervalo_saida_ter"],
                        "t_hr_intervalo_saida_qua" => $query[$i]["hr_intervalo_saida_qua"],
                        "t_hr_intervalo_saida_qui" => $query[$i]["hr_intervalo_saida_qui"],
                        "t_hr_intervalo_saida_sex" => $query[$i]["hr_intervalo_saida_sex"],
                        "t_hr_intervalo_saida_sab" => $query[$i]["hr_intervalo_saida_sab"],
                        "t_hr_turno_dom_saida" => $query[$i]["hr_turno_dom_saida"],
                        "t_hr_turno_sab_saida" => $query[$i]["hr_turno_sab_saida"],
                        "t_hr_turno_seg_saida" => $query[$i]["hr_turno_seg_saida"],
                        "t_hr_turno_ter_saida" => $query[$i]["hr_turno_ter_saida"],
                        "t_hr_turno_qua_saida" => $query[$i]["hr_turno_qua_saida"],
                        "t_hr_turno_qui_saida" => $query[$i]["hr_turno_qui_saida"],
                        "t_hr_turno_sex_saida" => $query[$i]["hr_turno_sex_saida"],
                        "t_ic_intrajornada" => $query[$i]["ic_intrajornada"]

                    );
                }
            }


            $retorno->status = true;
            $retorno->message = 'Dados carregados com sucesso';
            $retorno->data = $mysql_data;
            $retorno->iTotalDisplayRecords = count($query);
            $retorno->iTotalRecords = count($query);
        }
        else{
            $retorno->status = true;
            $retorno->message = 'Dados carregados com sucesso';
            $retorno->data = [];
            $retorno->iTotalDisplayRecords = 0;
            $retorno->iTotalRecords = 0;
        }


        echo json_encode($retorno);
        exit(0);
    }

    public function cancelarEscalasDemissao($colaborador_pk){
        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $fields = array();
        $fields['dt_cancelamento'] = "sysdate()";
        $fields['ds_motivo_cancelamento'] = 'Demitido';

        Util::execUpdate("agenda_colaborador_padrao", $fields, " colaboradores_pk = ".$colaborador_pk,$this->pdo);
      
        $retorno->status = true;
        $retorno->message = 'Dados atualizado com sucesso';
        $retorno->data = $colaborador_pk;
        
        return $retorno;
    }

    public function updateDataEscalaColaborador($colaborador_pk,$dt_atual,$nova_data,$leads_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio

        $sql ="";
        $sql.="update escala_dados_colaborador set dt_escala='".$nova_data."' where pk in(";
        $sql.="        select pk";
        $sql.="                from(";
        $sql.="                select e.pk";
        $sql.="                    from escala_dados_colaborador e";
        $sql.="                    INNER JOIN agenda_colaborador_padrao a on e.agenda_colaborador_padrao = a.pk";
        $sql.="                    where a.colaboradores_pk = ".$colaborador_pk;
        $sql.="                    and e.dt_escala = '".$dt_atual."'";
        $sql.="                )";
        $sql.="        X)";

        $stmt = $this->pdo->prepare( $sql );
        $stmt->execute();


        $retorno->status = true;
        $retorno->message = 'Informação alterada com sucesso';
        $retorno->data = [];

        return $retorno;
    }

    //COLOCA AQUI
    public function listaPostoXColaboradores($leads_pk,$colaboradores_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio


        $sql ="";
            $sql.="select";
            $sql.="     acp.pk"; 
            $sql.="     ,l.ds_lead";
            $sql.="     ,c.ds_colaborador";
            $sql.="     ,cri.n_qtde_dias_semana"; 
            $sql.="     ,ps.ds_produto_servico "; 
            $sql.="     ,date_format(acp.dt_inicio_agenda,'%d/%m/%Y') dt_inicio_agenda ";            
            $sql.="     ,date_format(acp.dt_fim_agenda,'%d/%m/%Y') dt_fim_agenda ";
            $sql.="     ,date_format(acp.dt_cancelamento,'%d/%m/%Y') dt_cancelamento "; 
            $sql.=" from agenda_colaborador_padrao acp ";
            $sql.="     inner join colaboradores c on acp.colaboradores_pk = c.pk ";
            $sql.="     inner join leads l on acp.leads_pk = l.pk ";
            $sql.="     left join contratos cr on acp.contratos_pk = cr.pk ";
            $sql.="     left join contratos_itens cri on cr.pk = cri.contratos_pk ";
            $sql.="     left join produtos_servicos ps on cri.produtos_servicos_pk  = ps.pk ";
            $sql.=" where 1=1";

            if(!empty($leads_pk)){
                $sql.=" And l.pk=".$leads_pk;
            }

            if(!empty($colaborador_pk)){
                $sql." And c.pk=".$colaborador_pk;
            }
            $sql.=" group by acp.pk "; 
            $sql.=" order by l.ds_lead";
                 
        $stmt = $this->pdo->prepare( $sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $rows;
        $retorno->iTotalDisplayRecords = count($rows);
        $retorno->iTotalRecords = count($rows);

        echo json_encode($retorno);
        exit(0);
    }


    public function pegarPostoDeTrabalhoPorLeadEColaborador($leads_pk,$colaboradores_pk){


        $retorno = new \StdClass; //Estrutura de retorno para controller
        $retorno->status = false; //Retorno setado status como false
        $retorno->data = []; //Retorno data setado como vazio


        $sql ="";
        $sql.="select";
        $sql.="     acp.pk";
        $sql.="     ,l.ds_lead";
        $sql.="     ,c.ds_colaborador";
        $sql.="     ,cri.n_qtde_dias_semana";
        $sql.="     ,ps.ds_produto_servico ";
        $sql.="     ,date_format(acp.dt_inicio_agenda,'%d/%m/%Y') dt_inicio_agenda ";
        $sql.="     ,date_format(acp.dt_fim_agenda,'%d/%m/%Y') dt_fim_agenda ";
        $sql.="     ,date_format(acp.dt_cancelamento,'%d/%m/%Y') dt_cancelamento ";
        $sql.=" from agenda_colaborador_padrao acp ";
        $sql.="     inner join colaboradores c on acp.colaboradores_pk = c.pk ";
        $sql.="     inner join leads l on acp.leads_pk = l.pk ";
        $sql.="     left join contratos cr on acp.contratos_pk = cr.pk ";
        $sql.="     left join contratos_itens cri on cr.pk = cri.contratos_pk ";
        $sql.="     left join produtos_servicos ps on cri.produtos_servicos_pk  = ps.pk ";
        $sql.=" where 1=1";

        if(!empty($leads_pk)){
            $sql.=" And l.pk=".$leads_pk;
        }

        if(!empty($colaboradores_pk)){
            $sql." And c.pk=".$colaboradores_pk;
        }
        $sql.=" group by acp.pk ";
        $sql.=" order by l.ds_lead";

        $stmt = $this->pdo->prepare( $sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $retorno->status = true;
        $retorno->message = 'Dados carregados com sucesso';
        $retorno->data = $rows;

        return $retorno;
    }
}
