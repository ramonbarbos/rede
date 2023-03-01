

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--BOOTSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!------------------------------------------------------------------------->

    <title>Login</title>

</head>
<body>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container-sm" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


    <form style="width: 600px;" method="post">


    <?php

        if(isset($_POST['acao'])){

            //Obtendo as informações do formulario
            $user = $_POST['user'];
            $password = $_POST['password'];
            //Fazendo a consulta no banco de dados para a Authenticação
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ? ");
            $sql->execute(array($user,$password));

            if($sql->rowCount() == 1){
                //Pegando informação no banco de dados
                $info = $sql->fetch();
                //Atribuindo as informações que esta no banco de dados para a Sessão
                $_SESSION['login'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                echo '<h6>Logado</h6>';
                if(isset($_GET['adicionar'])){
                    header('Location: '.INCLUDE_PATH.'noticia');
                }else if(isset($_GET['gerenciar'])){
                    header('Location: '.INCLUDE_PATH.'noticia');

                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL);

                }
                die();
            }else{
                echo '<h6>Usuario ou senha incorreto.</h6>';
            }

        }

    ?>
  
        <div class="mb-3">
            <label for="user" class="form-label">Login</label>
            <input type="text" class="form-control" id="user" name="user" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
       
        <a  class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH; ?>" >Voltar</a>
        <input type="submit" class="btn btn-outline-dark" value="Entrar" name="acao">
</form>

</div>
</section>





    <!--BOOTSTRAP JS-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>