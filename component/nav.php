<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/nav.css">

</head>
<body>
<nav  >
 
    <div class='nav__left'>
      <a href="<?php echo INCLUDE_PATH; ?>">
        <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/100px-Facebook_f_logo_%282019%29.svg.png' />
      </a>
      <div class='nav__search'>
        <i class="material-icons">search</i>
        <form  method="post" >
        <input type='text' name="parametro"  placeholder="Perquisar no Facebook"/>
        </form>
      </div>
    </div> 
   



    <div class='nav__mid'>
        <a href='<?php echo INCLUDE_PATH; ?>' class='icon'>
          <i class='material-icons'>home</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>slideshow</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>groups</i>
        </a>
        <a href='#' class='icon'>
          <i class='material-icons'>gamepad</i>
        </a>
    </div>



    <div class="nav__right">
        <a href='<?php echo INCLUDE_PATH; ?>usuario_single?user=<?php echo $_SESSION['user']?>' class="avatar">
           
           
            <?php  if(Painel::logado() == false){  ?>
           <img class='avatar__img' src="<?php echo INCLUDE_PATH ?>img/user.png" alt="">
           <span><strong>User</strong></span>
           <?php }else{  ?>
           <img class='avatar__img' src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
           <span><strong><?php echo $_SESSION['nome']; ?></strong></span>

           <?php }  ?>
        </a>
        <div class="buttons">
            <a href="<?php echo INCLUDE_PATH_PAINEL; ?>pages/cadastrar-noticia-feed?adicionar"><i class='material-icons'>add</i></a>
            <a href="#"><i class='material-icons'>messenger</i></a>
            <a href="#"><i class='material-icons'>notifications</i></a>

               <li class="nav-item dropdown">

                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class='material-icons'>arrow_drop_down</i>
                  <!-- MENU -->
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                     
                        <?php  if(Painel::logado() == false){  ?>
                          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL; ?>usuario_single?user">
                          <i style="font-size: 15px; margin-right:10px" class='material-icons'>login</i>Entrar</a>
                        <?php }else{  ?>
                          <a style="display: none;" class="dropdown-item">Perfil</a>
                          <?php }  ?>

                          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i style="font-size: 15px; margin-right:10px" class='material-icons'>folder</i>Painel</a>
                     
                     
                        
                          <a type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                          <i style="font-size: 15px; margin-right:10px" class='material-icons'>exit_to_app</i>
                            Sair
                        </a>
                      

                      </div>
              
                 </a>
              </li>
         </div>
      </div>
    

</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
Tem certeza que deseja sair?
</div>
<div class="modal-footer">
<a class="btn btn-danger" href="<?php echo INCLUDE_PATH ?>?logout">Sim</a>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
</div>
</div>
</div>
</div>

</body>
</html>

