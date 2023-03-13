<?php
	$url = explode('/',$_GET['url']);

	if(isset($_GET['user'])){
		$user = $_GET['user'];
	}else if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
	}

	//BUSCANDO O USUARIO
	if(isset($_GET['user'])){
		$verifica_usuario = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? ");
		$verifica_usuario->execute(array($user));

	}else{
			$verifica_usuario = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE  id = ?");
			$verifica_usuario->execute(array($id));
		
	}
	if($verifica_usuario->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticia');
	}
	$user_info = $verifica_usuario->fetch();


	///CONSULTANDO OS POST QUE O USUARIO FEZ
	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE id_user = ? ");
	$post->execute(array($user_info['id']));
	
	
	

	//NOTICIA EXISTENTE
	$post = $post->fetchAll();
?>

	<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/style-usuario.css">
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/feed.css">
	
	</head>
	<body>

	<div id="content-perfil" ><!--PERFIL-->
		
		<div id="perfil" class="">

			      <div class="capa-img">
					<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['capa'] ?>" alt="Card image cap">
				</div>

				<div class="content-card">

					<div id="card-user" class="">

						<div class="img-user">
							<img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['img'] ?>" alt="Card image cap">
						</div>
					
						<div class="info-user">
							<h5 class="card-title"><?php echo $user_info['nome'] ?></h5>
							<p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
							<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
						</div>

					</div>
				</div>	
		</div>


		
	</div><!--FIM DO PERFIL-->

	<section class="section-primary"  >

	<?php 
                    foreach($post as $key => $value) {
                     

					$user_id = $user_info['id'];
						
                     $usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));
                  ?>


	<div class="content-post"  ><!--INICIO NOTICIAS-->

						
				

			 
                        <!--INICIO USUARIO-->
                <div class="usuario" >

                    <div class="usuario-perfil" >

                      <a href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 	
					  	<img class="perfil-user" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
					 </a>

                     <div class="info-usuario">
						<h6  ><?php echo @$usuario_resposavel['nome'];?></h6>
						<p class=""><?php echo date('d/m/Y',strtotime($value['data']));?></p>
					</div>
                  </div>
                

				    <!--INICIO menu-->
					<a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="icon-post">  

                        <i class='material-icons'>more_horiz</i>
                      </div>

                      <!-- MENU -->
                          
                          <?php if( @$usuario_resposavel['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) { ?>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                
                                  <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>pages/gerenciar-noticia-feed?gerenciar=<?php echo $value['id']; ?>">Editar</a>
                          </div>
                              <?php }else{ ?>
                              
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="<?php echo INCLUDE_PATH?>noticia">Editar</a>
                              </div>

                            <?php   }  ?>

             </a><!--final menu-->


                </div><!--FINAL USUARIO-->

							<!--INICIO NOTICIAS-->
					<div class="card-post" >

								
							<div class="info-card">
							<p class="card-text"><?php echo substr($value['conteudo'],0,50).'...';?></p>
							
							</div>
							<div class="img-card">
								<img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt="Card image cap"  >
							</div>     

								<div class="card-body">

								

								</div>
							</div>



				</div> <!--FIM NOTICIAS-->
	<?php }	?>			
	</section>
		
	</body>
	</html>