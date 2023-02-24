

<nav class="navbar navbar-expand-lg navbar-light bg-light">
 
  

    <a class="navbar-brand" href="<?php echo INCLUDE_PATH_PAINEL?>">Painel de Controle</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    
    <div class="div" style=" width: 100%;display:flex; justify-content: end;"><!-- Inicio --> 
    
      <ul class="navbar-nav" >

       
      <li class="nav-item">
      <img style="height: 50px;width: 50px; border-radius: 100px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo INCLUDE_PATH_PAINEL ?>?logout">Sair</a>
        </li>
      
      </ul>
 

   

  </div><!-- Fim -->

</nav>

