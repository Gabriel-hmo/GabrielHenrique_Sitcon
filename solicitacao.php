<?php
    // print '<pre>';
    // var_dump($_POST);
    $nomePaciente = isset($_POST['nome']) ? $_POST['nome'] : '';
    $dataPaciente = isset($_POST['data']) ? $_POST['data'] : '';
    $cpfPaciente = isset($_POST['CPF']) ? $_POST['CPF'] : '';
    include_once('config.php');
    $sql = "SELECT * FROM profissional ORDER BY nome;";
    $sql2 = "SELECT * FROM tiposolicitacao ORDER BY descricao;";
    $sql3 = "SELECT * FROM procedimentos ORDER BY descricao;";
    $result = $conexao->query($sql);
    $registros = $result->fetch_all(PDO::FETCH_ASSOC);

    $result2 = $conexao->query($sql2);
    $registros2 = $result2->fetch_all(PDO::FETCH_ASSOC);

    $result3 = $conexao->query($sql3);
    $registros3 = $result3->fetch_all(PDO::FETCH_ASSOC);
    // var_dump($registros2);
    // print '</pre>';
    $idx = 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css\form.css" />
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark" id="nav">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav" >
                    <button id="btSoliciracao" type="button" class="btn btn-outline-light" onclick="window.location.href = 'index.php'">Solicitações Clinicas</button>
                    <button type="button" class="btn btn-outline-light" onclick="window.location.href = 'index.php'">Listagem de Solicitações</button>

                    
                </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="divForm">
        <form id="formSolicitacao" class="row g-3">
            <input type="hidden" name="idPaciente" value="<?= $_POST['id'] ?>">
            <div class="col-md-4">
                <label for="inputNome" class="form-label">Nome: </label>
                <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="nome" value="<?= $nomePaciente?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputNome">Data de Nascimento: </label>
                <input type="text" class="form-control" id="inputDtNasc" name="inputDtNasc" placeholder="dtNasc" value="<?= $dataPaciente?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputCPF">CPF: </label>
                <input type="text" class="form-control" id="inputCPF" name="inputCPF" placeholder="CPF" value="<?= $cpfPaciente?>" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputProfissional">Profissional: </label>
                <select name="profissional" id="profissional" class="form-select">
                    <option value = "0" selected> Selecione </option>
                    <?php
                    foreach($registros as $options){
                    ?>
                    <option value = "<?php echo $options[0]?>"><?php echo $options[1]?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputTipo">Tipo solicitação: </label>
                <select class="form-select" name="tipo" id="tipo" onchange="selectProcedimento(this.value)">
                    <option value = "0" selected> Selecione </option>
                    <?php
                    foreach($registros2 as $options){
                    ?>
                    <option value = "<?php echo $options[0]?>"><?php echo $options[1]?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputProcedimento">Procedimento: </label>
                <div id="divProcedimento">

                </div>
            </div>
            <div class="col-md-3">
                <label for="dataConsulta" class="form-lable">Data: </label>
                <input class="form-control" type="date" id="dataConsulta" name="dataConsulta">
            </div>
            <div class="col-md-3">
                <label for= "horaConsulta" class="form-lable">Hora: </label>
                <input class="form-control" type="time" id="horaConsulta" name="horaConsulta">
            </div>
            <!-- <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Clique em mim</label>
            </div> -->
            <div id="divBt">

                <button id="btSubmit" class="btn btn-primary" onclick="salvar()">Salvar</button>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js\solicitacao.js"></script>


<script>
    let procedimento = <?= !empty($registros3) ? json_encode($registros3, JSON_UNESCAPED_UNICODE) : "{}" ?>
                
</script>
</html>