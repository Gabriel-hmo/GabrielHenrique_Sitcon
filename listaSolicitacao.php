<?php
  include_once('config.php');
  $sql = "SELECT PA.nome AS nome, PA.CPF AS CPF, T.descricao AS descTipo, P. descricao AS descProcedimento, S.data as data
  FROM pacientes PA, tiposolicitacao T, solicitacao S, procedimentos P
  WHERE PA.id = S.pacientes_id AND S.procedimentos_id = P.id AND P.tipo_id = T.id;";
  $result = $conexao->query($sql);
  $solicitacoes = [];
  while($retornoPaciente = mysqli_fetch_object($result)){
    $solicitacoes[] = $retornoPaciente;
  }
  // var_dump($retotnoPaciente);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css\index.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <button id="btSolicitacao" type="button" class="btn btn-outline-light" onclick="window.location.href = 'index.php'">Solicitações Clinicas</button>
            <button type="button" class="btn btn-outline-light" onclick="window.location.href = 'listaSolicitacao.php'">Listagem de Solicitações</button>

        </div>
        </div>
    </div>
    </nav>
    <div id= "div-table">
        <table class="table table-striped bg-primary" id="table" >
            <thead id="tableH">
            <tr>
                <th scope="col">Paciente</th>
                <th scope="col">CPF</th>
                <th scope="col">Tipo Solicitacao</th>
                <th scope="col">Procedimento</th>
                <th scope="col">Data</th>
                <th scope="col">Hora</th>
            </tr>
            </thead>
            <tbody id="tableB">
            <?php foreach($solicitacoes as $key => $solicitacoes):?>
                <tr>
                <td><?= $solicitacoes->nome?></td>
                <td><?= $solicitacoes->CPF?></td>
                <td><?= $solicitacoes->descTipo?></td>
                <td><?= $solicitacoes->descProcedimento?></td>
                <td><?= date("Y-m-d", strtotime($solicitacoes->data));?></td>
                <td><?= date("H:i:s", strtotime($solicitacoes->data));?></td>
                
                </tr>
            <?php endforeach;?>
            
            </tbody>
        </table>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src= "js\listaSolicitacao.js"></script>
</html>