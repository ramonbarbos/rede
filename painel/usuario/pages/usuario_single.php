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




	<div id="content-perfil" ><!--PERFIL-->
		
		<div id="perfil" class="">

			      <div class="capa-img"><img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $user_info['capa'] ?>" alt="Card image cap"></div>

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

	<?php 
                    foreach($post as $key => $value) {
                     

					$user_id = $user_info['id'];
						
                     $usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));
                  ?>
	<section id="content-feed" >	

	<div id="container-feed" class="container"><!--INICIO NOTICIAS-->


				

			 
                        
                <div class="usuario d-flex" style="display:flex;  align-items: center;justify-content: space-between;"> <!--INICIO USUARIO-->
                    <div class="usuario-perfil " style="display:flex;  align-items: center;">

                      <a href="<?php echo INCLUDE_PATH_PAINEL_USUARIO; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> <img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap" style="width: 50px; height: 50px;border-radius: 30px;" > </a>

                      <h6 style="margin-left:10px" ><?php echo @$usuario_resposavel['nome'];?></h6>
                  </div>
                

                       <!--INICIO menu-->
                  <div class="btn-group dropstart"> 
                        <a class="dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>pages/gerenciar-noticia-feed?gerenciar=<?php echo $value['id']; ?>">Editar</a>
                        </div>

                    </div> <!--final menu-->

                </div><!--FINAL USUARIO-->

                <div class=" mt-4 mb-4" style="width: 100%;background-color:white;display:flex;">

                
               
                <img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt="Card image cap" style="width: 50%; height: 260px;" >      

                  <div class="card-body">

                    <h5 class="card-title"><?php echo $value['titulo'];?></h5>

                    <h6 class="card-subtitle mb-2 text-muted"><?php echo date('d/m/Y',strtotime($value['data']));?></p>
                    
                    <p class="card-text"><?php echo substr($value['conteudo'],0,50).'...';?></p>

                    <a href="<?php echo INCLUDE_PATH; ?>noticia/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>" class="card-link">Link da Noticia</a>
                  </div>
                </div>
			


	</div>			
	</section>
	<?php }	?>