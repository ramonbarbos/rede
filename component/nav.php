

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #329da8;justify-content: space-between;">
 
    <div class="container">
          <ul class="navbar-nav"> <!--PARTE 1 -->

              <a class="navbar-brand" href="<?php echo INCLUDE_PATH?>"><?php echo NOME_SITE; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo INCLUDE_PATH?>noticia">Noticia</a>
                  </li>
                
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo INCLUDE_PATH?>contato">Contato</a>
                  </li>

                  </div>
            
            
          </ul> <!--FINAL 1 -->

          <ul class="navbar-nav"> <!--PARTE 2 -->
          
        
               <li class="nav-item dropdown">

                  <!-- FOTO -->
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      

                    <?php  if(Painel::logado() == false){  ?>
                    <img style="height: 50px;width: 50px; border-radius: 100px;" src="<?php echo INCLUDE_PATH ?>img/user.png" alt="">
                    <?php }else{  ?>
                    <img style="height: 50px;width: 50px; border-radius: 100px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" alt="">
                    <?php }  ?>

                    </a>
                      <!-- MENU -->
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>">Painel</a>
                      <a class="dropdown-item" href="<?php echo INCLUDE_PATH ?>?logout">Sair</a>
                    </div>

                    </li>
              


            </li>
          </ul><!--FINAL 2 -->


        </div>
    </div>
</nav>