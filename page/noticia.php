
<?php 
  @$url = explode('/',$_GET['url']);
  if(!isset($url[2]))
  {
  $cat = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE slug = ?");
  $cat->execute(array(@$url[1]));
  $cat = $cat->fetch();
    //print_r($cat);
   //$cat['nome'];
?>






<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/feed.css">

</head>
<body>

<section class="section-primary" >

    <div class="container-post"><!--ADCIONAR NOTICIA-->

       <div class="post-1">
            <div class="content-img">
                      <?php if(Painel::logado() == false){ ?>
                        <div class="usuario-perfil" >
                          <img  src="<?php echo INCLUDE_PATH; ?>img/user.png" alt="Card image cap"  >
                        </div>
                        <?php }else{ ?>
                          <div class="usuario-perfil" >
                            <a  href="<?php echo INCLUDE_PATH; ?>usuario_single?user=<?php echo $_SESSION['user'];?>">
                              <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img'];?>" alt="Card image cap"  >
                            </a>
                          </div>
                          <?php } ?>
            
            </div>
                <a class="btn-add" href="<?php echo INCLUDE_PATH_PAINEL; ?>pages/cadastrar-noticia-feed?adicionar">
                 
                  <?php if(Painel::logado() == false){ ?>
                    <span>No que voce está pensando?</span>
                    <?php }else{ ?>
                    <span>No que voce está pensando, <?php echo   substr($_SESSION['nome'],0,7); ?>?</span>
                    <?php } ?>
                  
                  
                </a>
       </div>
       <div class="line"></div>

          <div class="post-2">

              <a class="buttonAdd" href="<?php echo INCLUDE_PATH_PAINEL; ?>pages/cadastrar-noticia-feed?adicionar" >

                <div class="icon-cam">
                 <i class='material-icons'>videocam</i>
                </div>
                <span>Video</span>

                  </a>

              <a class="buttonAdd" href="<?php echo INCLUDE_PATH_PAINEL; ?>pages/cadastrar-noticia-feed?adicionar">
                <div class="icon-photo">
                 <i class='material-icons'>photo_library</i>
                </div>
                <span>Foto</span>

                  </a>
             
          </div>

    </div>

                <?php 
                     $porPagina = 5;
                      //CONSULTAR
                     $query = "SELECT * FROM `tb_site.noticias` ";
                     if(@$cat['nome'] !=''){
                       $query.="WHERE categoria_id = $cat[id]";
   
                     }
   
                     //PESQUISAR
   
                     if(isset($_POST['parametro'])){
                       $busca = $_POST['parametro'];
   
                       if(strstr($query, 'WHERE') !== false){
                           $query.=" AND titulo LIKE '%$busca%' ";
                       }else{
                         $query.=" WHERE titulo LIKE '%$busca%' ";
                       }
                     }
   
                     //PAGINAÇÃO
                     
                       if(!isset($_POST['parametro'])){  //CASO NAO TENHA PARAMETRO
   
                         if(isset($_GET['pagina'])){
                           $pagina = (int)$_GET['pagina'];
                           $queryPg = ($pagina - 1) * $porPagina;
                           $query.=" ORDER BY id DESC LIMIT $queryPg,$porPagina";
                         }else{
                           $pagina = 1;
                           $query.=" ORDER BY id DESC LIMIT 0,$porPagina";
                         }
                       }else{
                         $query.=" ORDER BY id DESC";
                         
                       }
                     
                     //BUSCAR NOTICIA 
   
                     $sql =  MySql::conectar()->prepare($query);
                     $sql->execute();
                     $noticias = $sql->fetchAll();
                    foreach($noticias as $key => $value) {
                      $sql =  MySql::conectar()->prepare("SELECT  `slug` FROM  `tb_site.categoria` WHERE id = ? ");
                      $sql->execute(array($value['categoria_id']));
                      $categoriaNome = $sql->fetch()['slug'];


                      //Buscando usuario que publicou
                      
                      $user_id = $value['id_user'];
                     $usuario_resposavel = Painel::select('tb_admin.usuarios','id=?',array($user_id));
              ?>




<div class="content-post"  ><!--INICIO NOTICIAS-->

<!--INICIO USUARIO-->
  <div class="usuario" >
          <div class="usuario-perfil">

            <a class="pelicula-perfil-user" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 
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
        <a href="<?php echo INCLUDE_PATH; ?>noticia/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>" class="card-link">Ver mais</a>
      </div>
        <div class="img-card">
          <img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt="Card image cap"  >
         </div>     

          <div class="card-body">

           

          </div>
        </div>

    
        <?php echo '#publicacaoUser?id='.$value['id']; ?>
    
            <a type="submit" class="dropdown-item" data-bs-toggle="modal" href="<?php echo '#post';?>"  role="button" >
                Comentar
            </a>
       



      </div> <!--FIM NOTICIAS-->

        <?php } ?>

</section> <!--FIM TOTAL-->

   
<!-- Modal -->

<?php  ?>

<div class="modal fade" id="<?php echo 'post'?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Publicação de USER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
            

<div class="content-post"  ><!--INICIO NOTICIAS-->

<!--INICIO USUARIO-->
  <div class="usuario" >
          <div class="usuario-perfil">

            <a class="pelicula-perfil-user" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 
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
        <a href="<?php echo INCLUDE_PATH; ?>noticia/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>" class="card-link">Ver mais</a>
      </div>
        <div class="img-card">
          <img class="" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt="Card image cap"  >
         </div>     

          <div class="card-body">

           

          </div>
        </div>

        <?php  
      if(isset($_POST['comentario'])){
        $id_noticia = $value['id'];
        $nome_user = $usuario_resposavel['nome'];
        $comentario = $_POST['comentario'];
        
          if($comentario == ''){
              echo 'campo vazio!';
          }else{
            $arr = [ 'id_noticia'=>$id_noticia, 'nome_user'=>$nome_user,'comentario' => $comentario,'data'=>date('Y-m-d'),
              'nome_tabela'=>'tb_site.comentario'];
              Painel::insert($arr);
              echo  'adicionado';
          }
      }
       
        $coment = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentario` WHERE id_noticia = ?");
        $coment->execute(array($value['id']));
        $info_coment = $coment->fetchAll();
        
          if(@$info_coment['comentario'] == ''){
          foreach($info_coment as $key => $info) {

       ?>
       <h6>Publicado por: <?php echo $info['nome_user']; ?></h6>
        <p><?php echo $info['comentario']; ?></p>

        <?php } }else{ echo 'sem comentarios';}?>
       

            
<!--INICIO USUARIO-->
  <div class="usuario" >
          <div class="usuario-perfil">

            <a class="pelicula-perfil-user" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> 
               <img class="perfil-user" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
           </a>

               
        <form  method="post">
          <input type="text" name="comentario" placeholder="Digite um comentario">
        </form>
        <a class="dropdown-item" data-bs-toggle="modal" href="#publicacaoUser" role="button">
       
                            Comentar
        </a>
          
        </div>
      

         

      </div><!--FINAL USUARIO-->


      </div> <!--FIM NOTICIAS-->

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#publicacaoUser" data-bs-toggle="modal">não</button>
      </div>
    </div>
  </div>
</div>
 


        </body>
</html>

<?php }else{   include('page/noticia_single.php');}  ?>

