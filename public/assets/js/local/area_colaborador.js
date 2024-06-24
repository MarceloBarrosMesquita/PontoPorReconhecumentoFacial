//REGISTRAR PONTO
function fcTelaParaRegistrarPonto(){
    var objParametros = {
        "leads_pk":localStorage.getItem('leads_pk')
    };
    sendPost("area_colaborador", "receptivoRegistrarPonto", objParametros);
}

//NOVO REGISTRO
function inicio(){
    var objParametros = {};
    sendPost("area_colaborador", "receptivo", objParametros);
}
function novoRegistro(){
    var objParametros = {};
    sendPost("area_colaborador", "passo1", objParametros);
}
function passo2(){
    var objParametros = {};
    sendPost("area_colaborador", "passo2", objParametros);
}


function fcBuscarColaborador(){
    var id_empresa = $("#id_empresa").val();
    var id_colaborador = $("#id_colaborador").val();

    if(id_empresa==""){
        utilsJS.sweetMensagem(false,"Informe o Id Empresa.");
        return false;
    }
    if(id_colaborador==""){
        utilsJS.sweetMensagem(false,"Informe o Id Colaborador.");
        return false;
    }

    var objParametros = {
        "id_empresa": id_empresa,
        "id_colaborador": (id_colaborador),
        "leads_pk":localStorage.getItem('leads_pk')
    };

    var arrEnviar = carregarController("area_colaborador", "buscarColaborador", objParametros);

    if (arrEnviar.status == true){
        // Reload datable
        utilsJS.toastNotify(true, arrEnviar.message);
        setTimeout(function(){
            sendPost("area_colaborador", "passo3", objParametros);
        }, 2000);

    }
    else{
        utilsJS.toastNotify(false, arrEnviar.message);
    }
}
function passo3(){
    var id_empresa = $("#id_empresa").val();
    var id_colaborador = $("#id_colaborador").val();
    var objParametros = {
        "id_empresa": id_empresa,
        "id_colaborador": (id_colaborador),
        "leads_pk":localStorage.getItem('leads_pk')
    };
    sendPost("area_colaborador", "passo3", objParametros);
}


function passo4(){
    var id_empresa = $("#id_empresa").val();
    var id_colaborador = $("#id_colaborador").val();
    var objParametros = {
        "id_empresa": id_empresa,
        "id_colaborador": (id_colaborador),
        "leads_pk":localStorage.getItem('leads_pk')
    };
    sendPost("area_colaborador", "passo4", objParametros);
}
function fcTirarFoto(){
    var id_empresa = $("#id_empresa").val();
    var id_colaborador = $("#id_colaborador").val();
    var objParametros = {
        "id_empresa": id_empresa,
        "id_colaborador": (id_colaborador)
    };
    sendPost("area_colaborador", "tirar_foto_novo_registro", objParametros);
}



function redimensionarImagem(src, largura, altura, callback) {
    var img = new Image();
    img.onload = function() {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');

        // Padronizar o tamanho para 300x200
        canvas.width = 300;
        canvas.height = 200;


        ctx.drawImage(this, 0, 0, 300, 200);


        callback(canvas.toDataURL("image/png"));
    };
    img.src = src;
}
function fcEnviarFoto(){
    const photoDataUrl = webcamCanvas.toDataURL("image/png");

    redimensionarImagem(photoDataUrl, 300, 200, function(photoDataUrlRedimensionado) {
        // Agora, 'photoDataUrlRedimensionado' contém o URL base64 da imagem redimensionada

        // Aqui você pode prosseguir para salvar no banco de dados, comparar com outras imagens ou realizar outras operações.
        formdata.append("id_empresa",$("#id_empresa").val());
        formdata.append("id_colaborador",$("#id_colaborador").val());
        formdata.append("base64",photoDataUrlRedimensionado);




        $.ajax({
            type: 'POST',
            url: '/api/area_colaborador/salvarPrimeiroRegistro',
            data: formdata,
            processData: false,
            contentType: false,
            complete: function (response) {
                try {
                    var log = JSON.parse(response.responseText);
                    if(log.status==true) {
                        utilsJS.toastNotify(true, log.message);
                        setTimeout(function () {
                            sendPost("area_colaborador", "receptivo", {});
                        }, 2000);
                    }
                    else{
                        utilsJS.toastNotify(false,log.message);
                        setTimeout(function(){
                            sendPost("area_colaborador", "receptivo", {});
                        }, 2000);
                    }


                } catch (e) {
                    utilsJS.toastNotify(false,'Falhou a requisição para salvar o registro');
                }
            }
        });
    });


}
function fcSalvarCoordenadas(descriptor,colaborador_pk){
    formdata.append("coordenadas",(descriptor));
    formdata.append("colaborador_pk",colaborador_pk);

    $.ajax({
        type: 'POST',
        url: '/api/area_colaborador/salvarCoordenadas',
        data: formdata,
        processData: false,
        contentType: false,
        complete: function (response) {
            try {

            } catch (e) {
                utilsJS.toastNotify(false,'Falhou a requisição para salvar o registro');
            }
        }
    });
}



function buscarColaboradorManual(){

    var id_empresa = $("#id_empresa_manual").val();
    var id_colaborador = $("#id_colaborador_manual").val();

    /*if(id_empresa==""){
        utilsJS.sweetMensagem(false,"Informe o Id Empresa.");
        return false;
    }*/
    if(id_colaborador==""){
        utilsJS.sweetMensagem(false,"Informe o Id Colaborador.");
        return false;
    }

    var ds_pin = id_empresa+"-"+id_colaborador;

    formdataPonto.append("id_empresa", ds_pin);
    formdataPonto.append("id_colaborador", id_colaborador);
    formdataPonto.append("leads_pk", localStorage.getItem('leads_pk'));

    

    $.ajax({
        type: 'POST',
        url: '/api/area_colaborador/pegarInfoColaborador',
        data: formdataPonto,
        processData: false,
        contentType: false,
        complete: function (response) {
            try {
                var log = JSON.parse(response.responseText);
                if (log.status == true) {
                        
                        utilsJS.toastNotify(true, "ID localizado");
                        //PARTE PARA BATER O PONTO
                        $("#segundo_balao").css('display', 'inline');
                        $("#bater_foto").css('display', 'inline');


                        $("#ds_pin_ponto").val(log.data.arrColaborador['ds_pin']);
                        $("#id_colaborador_ponto").val(log.data.arrColaborador['colaborador_pk']);

                        //DADOS COLABORADOR
                        $("#txt_colaborador_pk").text(log.data.arrColaborador['colaborador_pk']);
                        $("#txt_pin").text(log.data.arrColaborador['ds_pin']);
                        $("#txt_ds_colaborador").text(log.data.arrColaborador['ds_colaborador']);
                        $("#txt_ds_rg").text(log.data.arrColaborador['ds_rg']);
                        $("#txt_ds_cpf").text(log.data.arrColaborador['ds_cpf']);
                        $("#txt_ds_razao_social").text(log.data.arrColaborador['ds_razao_social']);
                        $("#txt_ds_cnpj").text(log.data.arrColaborador['ds_cpf_cnpj']);

                        //DADOS PARA MONTAR COMBO LEAD
                        //var html = "<option value=''>Selecione um Lead</option>";
                        var html = "";
                        $.each(log.data.arrLead, function (k, v) {
                            html += "<option value='" + v['leads_pk'] + "'>" + v['ds_lead'] + "</option>";
                        });
                        $("select[name=leads_pk]").html(html);


                        //PARTE DA CAPTURA DA FOTO HTML
                        $("#primeiro_balao").css('display', 'none');
                        $("#terceiro_balao").css('display', 'none');
                        $("#capturar_foto").css('display', 'none');
                        $("#exibir_ponto_manual").css('display', 'none');
                   
                        //EXIBIR AS OPÇÕES DE PONTO 
                        calcularHorarioManual(log.data.arrLead[0]['hr_inicio_expediente']);


                        let arrPonto = log.data.arrPonto;
                        let contador = 0;
                        //VERIFICA SE BATEU O PONTO HOJE 
                        for(i=0;i<arrPonto.length;i++){
                         
                            if(arrPonto[i]['tipo_ponto_pk']==1){
                                $(".exibir_ponto_entrada").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==2){
                                $(".exibir_ponto_saida").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==3){
                                $(".exibir_ponto_saida_intervalo").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==4){
                                $(".exibir_ponto_retorno_intervalo").css('display', 'none');
                                contador+=1;
                            }
                        }

                        if(contador==4){
                            $(".exibir_aviso").css('display', 'inline');
                            
                        }
                        
                        
                        
                    
                } else {
                    utilsJS.toastNotify(false, log.message);
                    setTimeout(function () {
                        sendPost("area_colaborador", "receptivo", {});
                    }, 2000);
                }


            } catch (e) {
                utilsJS.toastNotify(false, 'Falhou a requisição para salvar o registro');
                utilsJS.loaded();
            }
        }
    });
}



function buscarColaboradorPontoManual(){

    var id_empresa = $("#id_empresa_manual").val();
    var id_colaborador = $("#id_colaborador_manual").val();

    /*if(id_empresa==""){
        utilsJS.sweetMensagem(false,"Informe o Id Empresa.");
        return false;
    }*/
    if(id_colaborador==""){
        utilsJS.sweetMensagem(false,"Informe o Id Colaborador.");
        return false;
    }

    var ds_pin = id_empresa+"-"+id_colaborador;

    formdataPonto.append("id_empresa", ds_pin);
    formdataPonto.append("id_colaborador", id_colaborador);
    formdataPonto.append("leads_pk", localStorage.getItem('leads_pk'));
    

    $.ajax({
        type: 'POST',
        url: '/api/area_colaborador/pegarInfoColaborador',
        data: formdataPonto,
        processData: false,
        contentType: false,
        complete: function (response) {
            try {
                var log = JSON.parse(response.responseText);
                if (log.status == true) {
                        
                        utilsJS.toastNotify(true, "ID localizado");
                        //PARTE PARA BATER O PONTO
                        $("#segundo_balao").css('display', 'inline');
                        $("#bater_ponto").css('display', 'inline');


                        $("#ds_pin_ponto").val(log.data.arrColaborador['ds_pin']);
                        $("#id_colaborador_ponto").val(log.data.arrColaborador['colaborador_pk']);

                        //DADOS COLABORADOR
                        $("#txt_colaborador_pk").text(log.data.arrColaborador['colaborador_pk']);
                        $("#txt_pin").text(log.data.arrColaborador['ds_pin']);
                        $("#txt_ds_colaborador").text(log.data.arrColaborador['ds_colaborador']);
                        $("#txt_ds_rg").text(log.data.arrColaborador['ds_rg']);
                        $("#txt_ds_cpf").text(log.data.arrColaborador['ds_cpf']);
                        $("#txt_ds_razao_social").text(log.data.arrColaborador['ds_razao_social']);
                        $("#txt_ds_cnpj").text(log.data.arrColaborador['ds_cpf_cnpj']);

                        //DADOS PARA MONTAR COMBO LEAD
                        //var html = "<option value=''>Selecione um Lead</option>";
                        var html = "";
                        $.each(log.data.arrLead, function (k, v) {
                            html += "<option value='" + v['leads_pk'] + "'>" + v['ds_lead'] + "</option>";
                        });
                        $("select[name=leads_pk]").html(html);


                        //PARTE DA CAPTURA DA FOTO HTML
                        $("#primeiro_balao").css('display', 'none');
                        $("#terceiro_balao").css('display', 'none');
                        $("#capturar_foto").css('display', 'none');
                        $("#exibir_ponto_manual").css('display', 'none');
                   
                        //EXIBIR AS OPÇÕES DE PONTO 
                        calcularHorarioManual(log.data.arrLead[0]['hr_inicio_expediente']);


                        let arrPonto = log.data.arrPonto;
                        let contador = 0;
                        //VERIFICA SE BATEU O PONTO HOJE 
                        for(i=0;i<arrPonto.length;i++){
                         
                            if(arrPonto[i]['tipo_ponto_pk']==1){
                                $(".exibir_ponto_entrada").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==2){
                                $(".exibir_ponto_saida").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==3){
                                $(".exibir_ponto_saida_intervalo").css('display', 'none');
                                contador+=1;
                            }
                            else if(arrPonto[i]['tipo_ponto_pk']==4){
                                $(".exibir_ponto_retorno_intervalo").css('display', 'none');
                                contador+=1;
                            }
                        }

                        if(contador==4){
                            $(".exibir_aviso").css('display', 'inline');
                            
                        }
                        
                        
                        
                    
                } else {
                    utilsJS.toastNotify(false, log.message);
                    setTimeout(function () {
                        sendPost("area_colaborador", "receptivo", {});
                    }, 2000);
                }


            } catch (e) {
                utilsJS.toastNotify(false, 'Falhou a requisição para salvar o registro');
                utilsJS.loaded();
            }
        }
    });
}
function calcularHorarioManual(specificTimeString){
    // String com o horário específico no formato "HH:MM:SS"
    //let specificTimeString = "10:00:00";
    // Obter a data e hora atual
    let now = new Date();

    // Dividir a string em horas, minutos e segundos
    let timeParts = specificTimeString.split(':');
    let specificHours = parseInt(timeParts[0], 10);
    let specificMinutes = parseInt(timeParts[1], 10);
    let specificSeconds = parseInt(timeParts[2], 10);

    // Criar um objeto Date para o horário específico na data de hoje
    let specificTime = new Date();
    specificTime.setHours(specificHours, specificMinutes, specificSeconds, 0);

    // Calcular a diferença em milissegundos
    let differenceInMilliseconds = now - specificTime;

    // Converter a diferença em um formato mais legível
    let differenceInSeconds = Math.floor(Math.abs(differenceInMilliseconds) / 1000);
    let differenceInMinutes = Math.floor(differenceInSeconds / 60);
    let differenceInHours = Math.floor(differenceInMinutes / 60);
    differenceInSeconds = differenceInSeconds % 60;
    differenceInMinutes = differenceInMinutes % 60;

    // Se a diferença for negativa, o horário específico é no futuro
    let isFuture = differenceInMilliseconds < 0;
    
    $(".mostrar_opc_ponto").css('display', 'none');

    if (isFuture) {
        if(differenceInHours==0){
            if(differenceInMinutes<=3){
                $(".mostrar_opc_ponto").css('display', 'inline');
                $(".exibir_pulsing").css('display', 'none');
            }
            else{
                $(".text").text("Aguardando para bater o ponto.");
            }
        }
        else{
            $(".text").text("Aguardando para bater o ponto.");
        }
        console.log(`Faltam: ${differenceInHours} horas, ${differenceInMinutes} minutos, ${differenceInSeconds} segundos para 10:00:00.`);
    } else {
        
        $(".mostrar_opc_ponto").css('display', 'inline');
        $(".exibir_pulsing").css('display', 'none');
        console.log(`Passaram: ${differenceInHours} horas, ${differenceInMinutes} minutos, ${differenceInSeconds} segundos desde 10:00:00.`);
    }
}
function fcExibirSelecaoPonto(){
    $("#bater_foto").css('display', 'none');
    $("#bater_ponto").css('display', 'inline');
}
function fcSalvarPontoManual(tipo_ponto){

    if($("#leads_pk").val()==""){
        utilsJS.toastNotify(false,"Por favor, Informe o Posto de serviço.");
        return false;
    }

    const photoDataUrl = webcamCanvas.toDataURL("image/png");
    
   
    redimensionarImagem(photoDataUrl, 300, 200, function(photoDataUrlRedimensionado) {
        // Agora, 'photoDataUrlRedimensionado' contém o URL base64 da imagem redimensionada

        // Aqui você pode prosseguir para salvar no banco de dados, comparar com outras imagens ou realizar outras operações.
        formdataBaterPonto.append("base64",photoDataUrlRedimensionado);

        formdataBaterPonto.append("ds_pin",$("#ds_pin_ponto").val());
        formdataBaterPonto.append("id_colaborador",$("#id_colaborador_ponto").val());
        formdataBaterPonto.append("ds_localizacao",$("#ds_localizacao").val());
        formdataBaterPonto.append("leads_pk",$("#leads_pk").val());
        formdataBaterPonto.append("tipo_ponto_pk",tipo_ponto);
        $.ajax({
            type: 'POST',
            url: '/api/area_colaborador/salvarPonto',
            data: formdataBaterPonto,
            processData: false,
            contentType: false,
            complete: function (response) {
                try {
                    var log = JSON.parse(response.responseText);
                    if(log.status==true) {
                        utilsJS.toastNotify(true, log.message);
                        setTimeout(function () {
                            sendPost("area_colaborador", "receptivo", {});
                        }, 2000);
                    }
                    else{
                        utilsJS.toastNotify(false,log.message);
                        setTimeout(function(){
                            sendPost("area_colaborador", "receptivo", {});
                        }, 2000);
                    }
    
    
                } catch (e) {
                    utilsJS.toastNotify(false,'Falhou a requisição para salvar o registro');
                }
            }
        });
    });
}
function fcSalvarPonto(tipo_ponto){

    if($("#leads_pk").val()==""){
        utilsJS.toastNotify(false,"Por favor, Informe o Posto de serviço.");
        return false;
    }

    formdataBaterPonto.append("ds_pin",$("#ds_pin_ponto").val());
    formdataBaterPonto.append("id_colaborador",$("#id_colaborador_ponto").val());
    formdataBaterPonto.append("base64",$("#base64Foto").val());
    formdataBaterPonto.append("leads_pk",$("#leads_pk").val());
    formdataBaterPonto.append("tipo_ponto_pk",tipo_ponto);

    $.ajax({
        type: 'POST',
        url: '/api/area_colaborador/salvarPonto',
        data: formdataBaterPonto,
        processData: false,
        contentType: false,
        complete: function (response) {
            try {
                var log = JSON.parse(response.responseText);
                if(log.status==true) {
                    utilsJS.toastNotify(true, log.message);
                    setTimeout(function () {
                        sendPost("area_colaborador", "receptivo", {});
                    }, 2000);
                }
                else{
                    utilsJS.toastNotify(false,log.message);
                    setTimeout(function(){
                        sendPost("area_colaborador", "receptivo", {});
                    }, 2000);
                }


            } catch (e) {
                utilsJS.toastNotify(false,'Falhou a requisição para salvar o registro');
            }
        }
    });
}


function fcListarLead(){
    var objParametros = {
    };

    var arrCarregar = carregarController("area_colaborador", "listarTodosPostTrabalho", objParametros);

    carregarComboAjax($("#leads_res_pk"), arrCarregar, " ", "pk", "ds_lead");
}

var formdata = null;
var formdataPonto = null;
var formdataBaterPonto = null;

$(document).ready(function()
    {
        formdata = new FormData();
        formdataPonto = new FormData();
        formdataBaterPonto = new FormData();

        fcListarLead();
        $("#leads_res_pk").change(function () {
            
            localStorage.setItem('leads_pk', $("#leads_res_pk").val());
            localStorage.setItem('ds_lead', $("#leads_res_pk option:selected").text());                
            
        });

        if(localStorage.getItem('leads_pk')){
            if(localStorage.getItem('leads_pk')!=""){
                $("#leads_res_pk").val(localStorage.getItem('leads_pk'))
            }
        }

        
        //Atribui os eventos NOVO REGISTRO VAI PARA O PASSO 1
        $(document).on('click', '#novoRegistro', novoRegistro);
        $(document).on('click', '#inicio', inicio);
        $(document).on('click', '#passo1', novoRegistro);
        $(document).on('click', '#passo2', passo2);
        $(document).on('click', '#passo3', passo3);
        $(document).on('click', '#buscarColaborador', fcBuscarColaborador);
        $(document).on('click', '#passo4', passo4);
        $(document).on('click', '#tirar_foto', fcTirarFoto);
        $(document).on('click', '#exibirBaterPonto', fcExibirSelecaoPonto);
        $(document).on('click', '#enviarFoto', fcEnviarFoto);

        //REGISTRAR PONOT DIRETO

        $(document).on('click', '#registrarPonto', fcTelaParaRegistrarPonto);
        //MASCARA
        //$("#id_colaborador").mask("9999999999");
        
        $(".chzn-select").chosen({ allow_single_deselect: true });


        


        

    }
);
