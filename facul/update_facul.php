<?php

 $read = $obj->readFacul("instituicao", $_GET['id']);

 if($_POST){
    $obj->updateFacul($_GET['id'],$_POST['nome'],$_POST['id_motorista']);
}

 foreach ($read as $key => $read) {
    $id = $read['id'];
    $nome = $read['nome'];
    $id_motorista = $read['id_motorista'];
    $nome_motorista = $read['nome_motorista'];
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
            <label>Selecione a sua instituição de ensino.</label>
            <select required class="form-control" type="text" name="id_motorista" value="<?php echo !empty($pass)? $pass : ''; ?>">
                <option value=<?php echo $id_motorista?>><?php echo $nome_motorista?></option>
                <?php $array = $obj->read('motorista');
                
                foreach ($array as $key => $row) {
                    echo '<option value='.$row['id'].'>'.$row['nome'].'</option>';
                }
                ?>
                </select>
            </div>
            </br>
            
            <div class="form-actions ">
                <button type="submit" class="btn btn-success">
                    Cadastrar
                </button>
                <a href="/contador_de_dedinhos/index.php?dir=facul&file=read_facul">
                    <button type="button" class="btn btn-secondary">Voltar</button>
                </a>    
            </div>
        </form>
    </div>
</body>
