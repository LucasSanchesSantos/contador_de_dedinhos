<?php
class banco
{
    private $host = "186.202.152.178";
    private $database = "bd_contador";
    private $user = "bd_contador";
    private $senha = "Informatica@10";
    private $conexao = null;

    public function __construct()
    {
        $this->conecta();
    }
    public function conecta()
    {
        try {
            $this->conexao = new PDO("mysql:host=$this->host;
            dbname=$this->database", "$this->user", "$this->senha");
        } catch (\PDOException $e) {
            echo "Não foi possível estabelecer a conexão 
            com o banco de dados: Erro" . $e->getCode();
        }
    }

    public function create($cpf,$nome,$telefone,$instituicao,$endereco,$rg,$email,$senha,$dias_semana)
    {
        $sql = "INSERT INTO alunos VALUES (0,'{$cpf}','{$nome}','{$telefone}','{$instituicao}',1,'{$endereco}','{$rg}','{$email}','{$senha}',$dias_semana)";
       
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();
        if ($resultado) {
            echo '<script>alert("Registrado com sucesso! Efetue seu login.");
         window.location.href="/contador_de_dedinhos/login.php";</script>';
        } else {
            echo '<script>alert("Erro no registro!");</script>;';
        }
    }

    public function read($tabela, $id = null)
    {

        if ($id != null) {
            $condicao = " where id = $id ";
        } else {
            $condicao = "";
        }

        $sql = "SELECT * FROM $tabela $condicao order by id desc";

        //prepara o sql
        $statement = $this->conexao->prepare($sql);
        //executa
        $statement->execute();
        //tras um array completo do sql
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    public function update($id_session,$cpf,$nome,$telefone,$instituicao,$endereco,$rg,$email,$senha,$dias_semana,$id_tipo_usuario)
    {
        $sql = "UPDATE alunos set id = $id_session,nome = '{$nome}',cpf = '{$cpf}',nome = '{$nome}',telefone = '{$telefone}',id_instituicao = $instituicao,id_tipo_usuario = $id_tipo_usuario,endereco = '{$endereco}',rg = '{$rg}',email = '{$email}',senha = '{$senha}',dias_semana = $dias_semana where id = $id_session" ;

        $statement = $this->conexao->prepare($sql);
        $update = $statement->execute();
        if($update){
            echo '<script> alert("Alterado com sucesso!");
            window.location.href="/contador_de_dedinhos/index.php";</script>';
        }else{
            echo '<script>alert("Erro no registro!")</script>';
        }
    }
    public function delete($table, $id){
        $sql = "delete from $table where id = $id";

        
        $statement = $this->conexao->prepare($sql);
        $delete = $statement->execute();
        if($delete){
            echo '<script> alert("Registro excluído com sucesso!");
            window.location.href="/contador_de_dedinhos";</script>';
        }else{
            echo '<script>alert("Erro na exclusão!")</script>';
        }
    }

    public function sigin($cpf, $senha)
    {
        $sql = "SELECT * FROM alunos where cpf = '$cpf' and senha = '$senha'";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = $statement->rowCount();
        //rowCount conta os resultados caso seja verdadeiro
        //var_dump($rows);

        if ($rows) {
            foreach ($array as $key => $value) {
                session_start();
                $_SESSION["id"] = $value['id'];
                $_SESSION["nome"] = $value['nome'];
                $_SESSION["login"] = true;
                $_SESSION["id_tipo_usuario"] = $value['id_tipo_usuario'];
                $_SESSION["cpf"] = $value['cpf'];
                $_SESSION["email"] = $value['email'];
                $_SESSION["id_instituicao"] = $value['id_instituicao'];
            }
            header('location: index.php');
            //funcao direcionar
        }else{
            echo '<script> alert("Login inválido!"); </script>';
        }
    }
    public function checkLogin(){
        if(!isset($_SESSION["login"]) or $_SESSION["login"] == false){
            header('Location: login.php');
        }
    }
    public function logout(){
        session_destroy();//destruir todas sessões
        $_SESSION['login'] = false;
        header('Location: login.php');
    }

    public function accountant($id_aluno,$contador,$id_instituicao)
    {
        $sql = "INSERT INTO contador VALUES (0,$id_aluno,$contador,CURDATE(),$id_instituicao)";
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
        echo '<script>alert("Alteração realizada!");
            window.location.href="/contador_de_dedinhos/alunos/contador.php";</script>';
        } else {
            echo '<script>alert("Erro no registro!");</script>;';
        }

    }

    public function readCount()
    {
        $session_aux = $_SESSION['id'];
        $sql = "SELECT sum(contador) as contador from contador where id_aluno = $session_aux and date = CURDATE()";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function total(){

        $var_aux = $_SESSION['id_instituicao'];
        $sql = 
        "SELECT 
        sum(c.contador) as contador 
        from contador c
            left join instituicao i on i.id = c.id_instituicao
            left join motorista m on m.id = i.id_motorista
        where c.date = CURDATE() 
            and i.id_motorista = (select id_motorista from instituicao where id = $var_aux)";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function createFacul($nome,$id_motorista)
    {
        $sql = "INSERT INTO instituicao VALUES (0,'{$nome}',$id_motorista)";
       
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();
        if ($resultado) {
            echo '<script>alert("Registrado com sucesso!");
         window.location.href="/contador_de_dedinhos/index.php?dir=facul&file=read_facul";</script>';
        } else {
            echo '<script>alert("Erro no registro!");</script>;';
        }
    }

    public function foundTotal(){

        $session_aux3 = $_SESSION['id_instituicao'];
        $sql = "SELECT limite from motorista where id = (select id_motorista from instituicao where id = $session_aux3)";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function readName($banco,$id_aluno)
    {
        $sql = "SELECT a.*
        ,i.nome as nome_instituicao 
        ,t.tipo_usuario as tipo_usuario
        FROM alunos a 
        left join instituicao i on a.id_instituicao = i.id 
        left join tipo_aluno t on a.id_tipo_usuario = t.id
        where a.id = $id_aluno";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    
    public function create_motorista($nome,$limite)
    {
        $sql = "INSERT INTO motorista VALUES (0,'{$nome}',$limite)";
       
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();
        if ($resultado) {
            echo '<script>alert("Registrado com sucesso!");
         window.location.href="/contador_de_dedinhos/index.php?dir=motorista&file=read";</script>';
        } else {
            echo '<script>alert("Erro no registro!");</script>;';
        }
    }

    public function readFacul($banco,$id_facul)
    {
        $sql = "SELECT 
        i.*
        ,m.nome as nome_motorista
        FROM instituicao i
        left join motorista m on m.id = i.id_motorista
        where i.id = $id_facul";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function readFacul2()
    {
        $sql = "SELECT 
        i.*
        FROM instituicao i";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }



    public function updateFacul($id, $nome, $id_motorista)
    {
        $sql = "UPDATE instituicao set id = $id,nome = '{$nome}', id_motorista = $id_motorista where id = $id" ;

        $statement = $this->conexao->prepare($sql);
        $update = $statement->execute();
        if($update){
            echo '<script> alert("Alterado com sucesso!");
            window.location.href="/contador_de_dedinhos/index.php?dir=facul&file=read;</script>';
        }else{
            echo '<script>alert("Erro no registro!")</script>';
        }
    }

    public function readMotorista($id_motorista)
    {
        $sql = "SELECT * FROM motorista where id = $id_motorista";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    
    public function readMotorista2()
    {
        $sql = "SELECT * FROM motorista";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function updateMotorista($id, $nome, $limite)
    {
        $sql = "UPDATE motorista set id = $id,nome = '{$nome}', limite = $limite where id = $id" ;
        $statement = $this->conexao->prepare($sql);
        $update = $statement->execute();
        if($update){
            echo '<script> alert("Alterado com sucesso!");
            window.location.href="/contador_de_dedinhos/index.php?dir=motorista&file=read";</script>';
        }else{
            echo '<script>alert("Erro no registro!")</script>';
        }
    }

    public function createAluno2($email){ //$cpf,$nome,$telefone,$instituicao,$endereco,$rg,$email,$senha,$dias_semana){
        
        $sql = "SELECT * FROM alunos where email = '{$email}'";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
       
    }
    
    public function createAluno($cpf,$nome,$telefone,$instituicao,$endereco,$rg,$email,$senha,$dias_semana){

        $sql = "INSERT INTO alunos VALUES (0,'{$cpf}','{$nome}','{$telefone}','{$instituicao}',1,'{$endereco}','{$rg}','{$email}','{$senha}',$dias_semana)";
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();
        if ($resultado) {
            echo '<script>alert("Registrado com sucesso! Efetue seu login.");
            window.location.href="/contador_de_dedinhos/login.php";</script>';
            } else {
               echo '<script>alert("Erro no registro!");</script>;';
            }
    }


    public function editFunction($cpf,$nome,$telefone,$instituicao,$endereco,$rg,$email,$senha,$dias_semana){
        try{
            if($this->existsFunction($email)){
                return "already_exists";
            }else{
                $sql = "INSERT INTO alunos VALUES (0,'{$cpf}','{$nome}','{$telefone}','{$instituicao}',1,'{$endereco}','{$rg}','{$email}','{$senha}',$dias_semana)";
                $statement = $this->conexao->prepare($sql);
                $resultado = $statement->execute();
                if ($resultado) {
                    echo '<script>alert("Registrado com sucesso! Efetue seu login.");
                window.location.href="/contador_de_dedinhos/login.php";</script>';
                } else {
                    echo '<script>alert("Erro no registro!");</script>;';
                }
            }
        }catch(Exception $err){
            echo 'Erro: ', $err->getMessage();
        }
    }

    public function existsFunction($email){
        try{
            $command = ("SELECT * FROM alunos
                                WHERE email = '{$email}'");
            $num_rows = $this->conexao->prepare($command)->num_rows;
            if($num_rows < 1){
                return false;
            }else{
                return true;
            }
        }catch(Exception $err){
            echo 'Erro: ', $err->getMessage();
        }
    }

    public function countOnibus()
    {
        $sql = 
        "SELECT
        m.id
        ,m.nome
        ,m.limite
        ,sum(c.contador) as contador
         from contador c 
            left join instituicao i on i.id = c.id_instituicao
            left join motorista m on m.id = i.id_motorista
         where c.date = CURDATE()
         group by 1,2,3";

        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function countFacul()
    {
        $sql = 
        "SELECT
        c.id_instituicao as id
        ,i.nome
        ,m.nome as nomemotorista
        ,sum(c.contador) as contador
        from contador c 
            left join instituicao i on i.id = c.id_instituicao
            left join motorista m on m.id = i.id_motorista
        where c.date = CURDATE()
        group by 1,2";

        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function accountantCancel($id_aluno,$contador,$id_instituicao)
    {
        $sql = "INSERT INTO contador_volta VALUES (0,$id_aluno,$contador,CURDATE(),$id_instituicao)";
        $statement = $this->conexao->prepare($sql);
        $resultado = $statement->execute();

        if ($resultado) {
        echo '<script>alert("Alteração realizada!");
            window.location.href="/contador_de_dedinhos/alunos/contador.php";</script>';
        } else {
            echo '<script>alert("Erro no registro!");</script>;';
        }

    }

    public function readCountCancel()
    {
        $session_aux = $_SESSION['id'];
        $sql = "SELECT 
        m.nome
        ,sum(c.contador) as contador 
        from contador_volta c 
            left join instituicao i on i.id = c.id_instituicao
            left join motorista m on m.id = i.id_motorista
        where c.id_aluno = $session_aux and date = CURDATE()";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function filtroRelatorio($instituicao,$motorista,$dini,$dfim)
    {
        if($instituicao == 0 and $motorista == 0){
            $genio = "c.date BETWEEN '{$dini}' and '{$dfim}'";
        }elseif($instituicao == 0 and $motorista <> 0){
            $genio = "c.date BETWEEN '{$dini}' and '{$dfim}' and m.id = $motorista";
        }elseif($motorista == 0 and $instituicao <> 0){
            $genio = "c.date BETWEEN '{$dini}' and '{$dfim}' and i.id = $instituicao";
        }else{
            $genio = "c.date BETWEEN '{$dini}' and '{$dfim}' and i.id = $instituicao and m.id = $motorista";
        }

        $sql = "SELECT 
        a.id as id_aluno
        ,a.nome as nome_aluno
        ,m.nome as nome_motorista
        ,i.nome as nome_instituicao
        ,c.date
        ,case when sum(c.contador) = 1 then 'Foi a aula' else 'Não foi' end as situacao
        from contador c 
            left join instituicao i on i.id = c.id_instituicao
            left join motorista m on m.id = i.id_motorista
            left join alunos a on a.id = c.id_aluno
        where $genio
        
        GROUP BY 1,2,3,4,5";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

}

