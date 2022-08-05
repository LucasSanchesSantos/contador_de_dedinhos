<?php 
include 'classes/banco.class.php';
$obj = new banco;
session_start();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

    if($_POST){
        $obj->filtroRelatorio($_POST['instituicao'],$_POST['motorista'],$_POST['dini'],$_POST['dfim']);
    }

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/contador_de_dedinhos/css/style.css">

    <header class="d-flex">
        <div class="container d-flex align-items-center justify-content-between">

            <h1>Relatório de presença</h1>
            <div class="welcome">
                <a href="/contador_de_dedinhos/index.php" class="text-white"> Voltar </a>
            </div>
            <!-- <h1><img src="/contador_de_dedinhos/img/normal_like.png"></h1> -->
        </div>
    </header>
    
<body>


<div class="d-flex justify-content-center p-2">
    <form action="" method="POST">
        <div class="btn">
            <label>Selecione instituição de ensino.</label>
            <select required class="form-control text-center" type="text" name="instituicao" value="<?php echo !empty($instituicao)? $instituicao : ''; ?>">
                <option value="0">Todos</option>
                <?php $array = $obj->readFacul2();
                foreach ($array as $key => $row) {
                    echo '<option value='.$row['id'].'>'.$row['nome'].'</option>';
                }
                ?>
            </select>
        </div>
                
        <div class="btn">
            <label>Selecione o motorista</label>
            <select required class="form-control text-center" type="text" name="motorista" value="<?php echo !empty($motorista)? $motorista : ''; ?>">
                <option value="0">Todos</option>
                <?php $array = $obj->readMotorista2();
                foreach ($array as $key => $row) {
                    echo '<option value='.$row['id'].'>'.$row['nome'].'</option>';
                }
                ?>
            </select>
        </div>
        
        <div class="form-group btn">
            <label>Data inicio</label>
            <input type="date" required  class="form-control"
            name="dini" value="<?php $date = date('Y-m-d'); echo $date;?>">
        </div>

        <div class="form-group btn">
            <label>Data inicio</label>
            <input type="date" required  class="form-control"
            name="dfim" value="<?php echo $date;?>">
        </div>

        <button type="submit" class="btn btn-success " >
            Filtrar
        </button>
    </form>
</div>




</br>
    <main class="mt-5 col-md-12 p-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id aluno</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Instituição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Situação</th>

                </tr>
            </thead>
            <tbody>
            <?php
            if($_POST){
                $array = $obj->filtroRelatorio($_POST['instituicao'],$_POST['motorista'],$_POST['dini'],$_POST['dfim']);
                foreach ($array as $key => $row) {
                    echo '<tr>';
                    echo '<th>'. $row['id_aluno'].'</th>';
                    echo '<td>'. $row['nome_aluno'].'</td>';
                    echo '<td>'. $row['nome_motorista'].'</td>';
                    echo '<td>'. $row['nome_instituicao'].'</td>';
                    echo '<td>'. $row['date'].'</td>';
                    echo '<td>'. $row['situacao'].'</td>';
                }
            }
    
            ?>
            </tbody>
        </table>
    </main>

    <!-- PARA COMENTAR UMA LINHA É SÓ DAR CTRL + ; -->
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>