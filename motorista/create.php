<?php 

if($_POST){
    $obj->create_motorista($_POST['nome'],$_POST['limite']);
}
//var_dump($_POST)
?>
<body>
<div class="d-flex justify-content-center p-2">
    <form action="" method="POST">
        <div class="form-group">
        <label>Nome</label>
            <input type="text"  required  class="form-control"
            name="nome" placeholder="Ex: Marcio" 
            value="<?php echo !empty($nome)? $nome : ''; ?>">
            
            <?php if(!empty($nomeErro)): ?>
                <span class="text-danger">
                    <?php echo  $nomeErro; ?>
                </span>
            <?php endif; ?> 
        </div>

        <label>Limite de alunos</label>
            <input type="text"  required  class="form-control"
            name="limite" placeholder="Ex: 50" 
            value="<?php echo !empty($limite)? $limite : ''; ?>">
            
            <?php if(!empty($limiteErro)): ?>
                <span class="text-danger">
                    <?php echo  $limiteErro; ?>
                </span>
            <?php endif; ?> 
        

        </br>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                Cadastrar
            </button>
            <a href="/contador_de_dedinhos/index.php?dir=motorista&file=read">
                <button type="button" class="btn btn-secondary">Voltar</button>
            </a>
        </div>
    </form>

            
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</div>
</body>