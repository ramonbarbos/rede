
<?php



verificaPermissaoPagina(0);

if(isset($_GET['excluir'])){

    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.noticias',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticia');

}
 $id = (int)$_GET['gerenciar']; 
 $noticia = Painel::select('tb_site.noticias','id=?',array($id));



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <!--TINYMCE-->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOME_SITE?></title>
</head>
<body>
    
                    <div class="container-sm" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">

                    <form style="width: 600px;" method="post" enctype="multipart/form-data">

                    <?php  
                    if(isset($_POST['acao'])){

                    }
                    ?>

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Data</th>
                        <th scope="col">Capa</th>
                    
                        </tr>
                    </thead>

                    <tbody>

                        

                        <tr>
                        <td><?php echo $noticia['titulo']?></td>
                        <td><?php echo $noticia['categoria_id'];?></td>
                        <td><?php echo $noticia['data'];?></td>
                        <td><img style="width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $noticia['capa'] ?>" alt=""></td>
                        <td><a  href="<?php echo INCLUDE_PATH_PAINEL ?>editar-noticia?id=<?php echo $noticia['id']; ?>" class="btn btn-warning">Iditar</a></td>
                        <td> <a <?php verificaPermissaoMenu(2) ?> type="button" class="btn btn-danger" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticia?excluir=<?php echo $value['id']; ?>">Excluir</a></td>

                        </tr>
                     
                    </tbody>
                    </table>

                    <nav class="container">


                    <a class="btn btn-outline-primary" href="<?php echo INCLUDE_PATH?>noticia">Voltar</a>

                    </nav>

                    </div>

                     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
