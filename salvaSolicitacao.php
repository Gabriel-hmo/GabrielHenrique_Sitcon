<?php 
    // ini_set('display_errors', 1);
    //Alteramos o cabeçalho para não gerar cache do resultado
    header('Cache-Control: no-cache, must-revalidate'); 
    //Alteramos o cabeçalho para que o retorno seja do tipo JSON
    header('Content-Type: application/json; charset=utf-8');
    ini_set("display_errors", 1);ini_set("display_startup_errors", 1);error_reporting(E_ALL);
    include_once('config.php');
    // print "<pre>";
    // var_dump($_POST);
    
    try{

        $retorno = [];

        $idPaciente = isset($_POST['idPaciente']) ? $_POST['idPaciente'] : '';
        $idProfissional = isset($_POST['profissional']) ? $_POST['profissional'] : '';
        $idProcedimento = isset($_POST['procedimento']) ? $_POST['procedimento'] : '';
        $idExame = isset($_POST['exame']) ? $_POST['exame'] : '';
        $dataC = isset($_POST['dataConsulta']) ? $_POST['dataConsulta'] : '';
        $horaC = isset($_POST['horaConsulta']) ? $_POST['horaConsulta'] : '';

        // $horaMod = str_replace(":", "-", $horaC);

        $data = "'".$dataC . " " . $horaC."'";

        // var_dump($idExame);

        if($idPaciente == '' || $idProfissional == ''){
            $retorno['status'] = false;
            $retorno['retorno'] = "Campos Incompletos";
        }else if($idExame != ''){
            foreach($idExame as $exame){
                // var_dump("Examee: ".$exame);
                $sql = "INSERT INTO solicitacao (
                    data,
                    pacientes_id,
                    procedimentos_id,
                    profissional_id
                ) VALUES(
                    $data,
                    $idPaciente,
                    $exame,
                    $idProfissional
                )";
                // die('<pre>'.$sql);
                $result = $conexao->query($sql);
                if($result){
                    $retorno['status'] = true;
                    $retorno['retorno'] = "Solicitacao cadastrada";
                }else{
                    $retorno['status'] = false;
                    $retorno['retorno'] = "Erro ao cadastrar Solicitacao";
                }
            }
        }else{
            $sql = "INSERT INTO solicitacao (
                data,
                pacientes_id,
                procedimentos_id,
                profissional_id
            ) VALUES(
                $data,
                $idPaciente,
                $idProcedimento,
                $idProfissional
            )";
            // die('<pre>'.$sql);
            $result = $conexao->query($sql);
            if($result){
                $retorno['status'] = true;
                $retorno['retorno'] = "Solicitacao cadastrada";
            }else{
                $retorno['status'] = false;
                $retorno['retorno'] = "Erro ao cadastrar Solicitacao";
            }
            // var_dump($result);
        }
        // var_dump($retorno);
        // echo gettype(json_encode($retorno)) . "<br>";
        print(json_encode($retorno));

    }catch(Exception $e){
        $retorno['status'] = false;
        $retorno['retorno'] = $e;
        // var_dump($retorno);
        // var_dump( gettype(json_encode($retorno)));
        print(json_encode($retorno));
    }
?>


