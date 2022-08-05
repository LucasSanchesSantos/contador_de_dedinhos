<head>

<section class="container p-2">
<table class="table table-striped">
    <a href="index.php">
        <button type="button" class="btn btn-secondary">Voltar</button>
    </a>
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">Limite de alunos</th>
            <th scope="col"><a href="?dir=motorista&file=create"><div class="btn btn-success">Cadastrar</div></a></th>
            

        </tr>
    </thead>
    <tbody>
    <?php
    $array = $obj->read('motorista');
    foreach ($array as $key => $row) {
        echo '<tr>';
        echo '<th>'. $row['id'].'</th>';
        echo '<td>'. $row['nome'].'</td>';
        echo '<td>'. $row['limite'].'</td>';
        echo '<td width=250>';
        echo ' <a class="btn btn-warning" href="?dir=motorista&file=update&id='.$row['id'].'">Editar</a>';
        echo ' <a class="btn btn-danger"  href="?dir=motorista&file=delete&id='.$row['id'].'">Apagar</a>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
</tbody>
</table>
