<?php
 
    if($_POST){
        $obj->delete('motorista',$_GET['id']);
    }
?>

<div class="d-flex justify-content-center p-2">
<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="alert alert-danger">
        Deseja realmente excluir esse motorista?
    </div>
    <div class="form-actions">
            <button type="submit"  class="btn btn-success">
                Sim
            </button>
            <a href="/contador_de_dedinhos/index.php?dir=motorista&file=read" class="btn btn-default">Não</a>
    </div>
</form>
</div>