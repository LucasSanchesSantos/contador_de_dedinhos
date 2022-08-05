<?php
 
    if($_POST){
        $obj->delete('instituicao',$_GET['id']);
    }
?>
<div class="d-flex justify-content-center p-2">
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="alert alert-danger">
        Deseja realmente excluir essa universidade?
    </div>
    <div class="form-actions">
            <button type="submit"  class="btn btn-success">
                Sim
            </button>
            <a href="/contador_de_dedinhos/index.php?dir=facul&file=read_facul" class="btn btn-default">Não</a>
    </div>
</form>
</div>