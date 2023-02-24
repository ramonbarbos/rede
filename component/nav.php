

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #329da8;">
  <a class="navbar-brand" href="<?php echo INCLUDE_PATH?>"><?php echo NOME_SITE; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    
    <li class="nav-item">
        <a class="nav-link" href="<?php echo INCLUDE_PATH?>noticia">Noticia</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="<?php echo INCLUDE_PATH?>contato">Contato</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>">Painel</a>
        </div>
      </li>
    </ul>
  </div>
</nav>