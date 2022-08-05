<?php

 $read = $obj->readMotorista($_GET['id']);

 if($_POST){
    $obj->updateMotorista($_GET['id'],$_POST['nome'],$_POST['limite']);
}

 foreach ($read as $key => $read) {
    $id = $read['id'];
    $nome = $read['nome'];
    $limite = $read['limite'];
}
?>
<body>
    <div class="d-flex justify-content-center p-2">
        <form action="" method="POST">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" required class="form-control"
                name="nome" placeholder="Nome completo"
                value="<?php echo !empty($nome)? $nome : ''; ?>"> 
                <?php if(!empty($nomeErro)): ?>
                    <span class="text-danger">
                        <?php echo  $nomeErro; ?>
                    </span>
                <?php endif; ?> 
            </div>

            <div class="form-group">
                <label>Limite de alunos</label>
                <input type="numeric" required class="form-control"
                name="limite" placeholder="Ex: 50"
                value="<?php echo !empty($limite)? $limite : ''; ?>"> 
                <?php if(!empty($limiteErro)): ?>
                    <span class="text-danger">
                        <?php echo  $limiteErro; ?>
                    </span>
                <?php endif; ?> 
            </div>
            </br>
            
            <div class="form-actions ">
                <button type="submit" class="btn btn-success">
                    Cadastrar
                </button>
                <a href="/contador_de_dedinhos/index.php?dir=motorista&file=read">
                    <button type="button" class="btn btn-secondary">Voltar</button>
                </a>    
            </div>
        </form>
    </div>
</body>
