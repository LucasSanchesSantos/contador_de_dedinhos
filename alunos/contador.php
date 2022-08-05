<?php 
include 'classes/banco.class.php';
$obj = new banco;
session_start();

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

            <h1>Marcar presença</h1>
            <div class="welcome">
                <a href="/contador_de_dedinhos/index.php" class="text-white"> Voltar </a>
            </div>
            <!-- <h1><img src="/contador_de_dedinhos/img/normal_like.png"></h1> -->
        </div>
        
    </header>
    
<body>
    
    
    <?php
    $array = $obj->total('contador');        
    foreach ($array as $key => $value) {
            $value['contador'];
    }   
    $var_aux1 = $value['contador'];

    $array = $obj->foundTotal('limite');        
    foreach ($array as $key => $value) {
            $value['limite'];
    }   
    $var_aux3 = $value['limite'];
    //echo $var_aux3;
    

    if($var_aux1 >= $var_aux3) {
        echo "O limite de passageiros já está excedido, sinto muito minha joia! :( </br> Qualquer coisa, contate a gente da comissão.";
    }
    else{

        $array = $obj->readCount('contador');        
        foreach ($array as $key => $row) {
                $row['contador'];
        }   
        $var_aux2 = $row['contador'];

        ?>
        <div class="mt-3 d-flex justify-content-center">
            <?php if($var_aux2 == 0) {
                echo "<h2>Marque sua presença</h2>";
            }else{
                echo "<h2 id=msg>Presença Marcada</h2>";
            }
            
            ?>
            
        </div>
        <div class="form-group d-flex justify-content-center">
            
            <form action="" method="POST">
                <input type="submit" id=span1 name="um" value="1" class="btn bg-transparent text-white" style="width:100;height:100">
                <input type="submit" id=span2 name="um" value="-1" class="btn bg-transparent text-white" style="width:100;height:100">
            </form>
        </div>

        <?php
        if($var_aux2 == 1){?>
            <div class="d-flex justify-content-center">
                <b id="msg">Tu ta registrado para o busão hoje, minha bênção! Não vai perder a hora, em!</b>
            </div>
        <?php }
        if ($var_aux2 >= 1){
            if($_POST){
                if($_POST['um'] < 0){
                    $obj->accountant($_SESSION['id'],$_POST['um'],$_SESSION['id_instituicao']);
                }else{
                    echo '<script>alert("Você não pode se registrar duas vezes, minha joia!");</script>';
                }
            }
            
        }elseif($var_aux2 <= 0){
            if($_POST){
                if($_POST['um'] < 0){
                    echo '<script>alert("Você não esta regristrado hoje ainda, minha benção!");</script>';
                }else{
                    $obj->accountant($_SESSION['id'],$_POST['um'],$_SESSION['id_instituicao']);
                }
            }
        }
    }
    echo '</br>';
    ?>
    <table class="table d-flex justify-content-center">
        <thead>
            <tr>
                <th scope="col"><h3>Total de alunos hoje</h3></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="d-flex justify-content-center" id=numero_total>
        <th><?php echo "$var_aux1/$var_aux3";?></br>
    </div>

    
    <?php 
    
    if($var_aux2 == 1){

    $array = $obj->readCountCancel();        
    foreach ($array as $key => $row) {
            $row['contador'];
    }   
    $var_1 = $row['contador'];
    $var_2 = $row['nome']; ?>

    <div class="mt-5 p-2">

        <?php 
        if($var_1 == 0){
            echo "<div class='mt-5 d-flex justify-content-center p-2'><h2>Não vai voltar com o ônibus? Cliquei no dedo abaixo!</h2> </div>";
        }else{
            echo "<div class='mt-5 d-flex justify-content-center p-2'><h2>Deseja voltar com o ônibus? Clique no dedinho verde!</h2> </div>";
        }

        ?>


        <div class="form-group d-flex justify-content-center">
            
            <form action="" method="GET">
            <?php if($var_1 < 0){ ?>
                <input type="submit" id=span1 name="one" value="1" class="btn bg-transparent text-white" style="width:100;height:100">
            <?php } ?>
                <input type="submit" id=span2 name="one" value="-1" class="btn bg-transparent text-white" style="width:100;height:100">
            </form>
        </div>

        

        <?php
        
        if($_GET){
            if($var_1 == 0){
                if($_GET['one'] < 0){
                    $obj->accountantCancel($_SESSION['id'],$_GET['one'],$_SESSION['id_instituicao']);
                }else{
                    echo '<script>alert("Seu lugar de volta esta guardado já, estamos no seu aguardo! :D");</script>';
                }
            }elseif($var_1 < 0){
                if($_GET['one'] < 0){
                    echo '<script>alert("Você já avisou que não gosta da gente! Pode ficar na paz.");</script>';
                }else{
                    $obj->accountantCancel($_SESSION['id'],$_GET['one'],$_SESSION['id_instituicao']);
                }
            }
        }

        ?>
    <?php }?>
    </div>







</tbody>


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