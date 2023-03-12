
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
  <script src="<?php echo INCLUDE_PATH?>js/jquery-3.6.3.js"></script>

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

     

            
      <!--INICIO AÇÃO-->
        <div class="acao-post" style="">
            <div class="content-acao" style=" ">

                  <a class="btn-curtir"   >
                            <i class='material-icons' >thumb_up</i>
                             <span>Curtir</span> 
                  </a>

                    <a class="btn-comentar" onclick="listFeed(<?php echo $value['id']?>)" data-bs-toggle="modal" href="#feedUser" role="button">
                            <i  class='material-icons'>chat</i>
                              <span>Comentar</span> 
                  </a>
                  <a class="btn-repost" style=" ">
                            <i  class='material-icons'>share</i>
                              <span>Compartilhar</span> 
                  </a>
                          
   
            
            </div>
           

         

        </div><!--FINAL AAÇÃO-->


      </div> <!--FIM NOTICIAS-->
   

        <?php } ?>

</section> <!--FIM TOTAL-->


 
<!-- Modal -->


<div class="modal fade" id="feedUser" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Aviso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div id="idFeed" ></div>

        <!--INICIO USUARIO-->
          <div class="usuario" >
                  <div class="usuario-perfil">

                    <a class="pelicula-perfil-user" href=""> 
                     
                     <span class="perfil-user" id="imgUser" ></span>

                  </a>

                    <div class="info-usuario">
                      <h6  ><span id="nomeUser"  ></span></h6>
                      <p class=""><span id="dataFeed" ></span></p>
                    </div>
                </div>
      


       

      </div><!--FINAL USUARIO-->

           <!--INICIO NOTICIAS-->
         <div class="card-post" >
          
                <div class="info-card">
                  <span id="conteudoFeed" ></span>
                </div>

                <div class="img-card">
                    <span id="capaFeed" ></span>
                </div>     
         
        </div>

     

            
      <!--INICIO AÇÃO-->
        <div class="acao-post" style="">
            <div class="content-acao" style=" ">

                  <a class="btn-curtir"   >
                            <i class='material-icons' >thumb_up</i>
                             <span>Curtir</span> 
                  </a>

                    <a class="btn-comentar" >
                            <i  class='material-icons'>chat</i>
                              <span>Comentar</span> 
                  </a>
                  <a class="btn-repost" style=" ">
                            <i  class='material-icons'>share</i>
                              <span>Compartilhar</span> 
                  </a>
                                  
            </div>

        </div><!--FINAL AAÇÃO-->

        <div class="comentarios-container">
              
              <?php  
                  if(isset($_POST['comentario'])){
                    $id_noticia = $value['id'];
                    $id_user = $usuario_resposavel['id'];
                    $nome_user = $usuario_resposavel['nome'];
                     $img_user = $usuario_resposavel['img'];
                    $comentario = $_POST['comentario'];
                    
                      if($comentario == ''){
                          echo 'campo vazio!';
                      }else{
                        $arr = [ 'id_noticia'=>$id_noticia, 'id_user'=>$id_user,'nome_user'=>$nome_user,'img_user'=>$img_user,'comentario' => $comentario,'data'=>date('Y-m-d'),
                          'nome_tabela'=>'tb_site.comentario'];
                          Painel::insert($arr);
                          echo  'adicionado';
                      }
                  }
                    #BUSCANDO OS COMENTARIOS DO POST PELO ID DA NOTICIA
                    $coment = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentario` WHERE id_noticia = ?");
                    $coment->execute(array($value['id']));
                    $info_coment = $coment->fetchAll();
                    
                    
                      if(isset($info_coment['comentario']) == ''){
                        foreach($info_coment as $key => $info) {

                  ?>
                  <div class="container-coment">

                      <div class="content-coment">
                            <div class="content-user-coment">
                                  <a class=""> 
                                    <img class="perfil-user-coment" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
                                </a>
                              </div>
                              <div class="coment">
                                <h6><b><?php echo $info['nome_user']; ?></b></h6>
                                <p><?php echo $info['comentario']; ?></p>

                          </div>
                        <?php } }else{ echo 'sem comentarios';}?>
                        </div>
                        <div class="form-comentario" >
                             <a class="" href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo $info['id_user'];?>"> 
                                    <img class="perfil-user-coment" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap"  >
                                </a>
                              <form  method="post">
                                    <input type="text" name="comentario" placeholder="Escreva um comentario...">
                              </form>
                        </div>
                 
              </div>
        </div>


      </div> <!--FIM NOTICIAS-->
   
     
       
   
      </div>
     
  </div>
</div>

<script src="js/custom.js"></script>


        </body>
</html>

<?php }else{   include('page/noticia_single.php');}  ?>

