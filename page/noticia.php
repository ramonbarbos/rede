
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

  <link rel="stylesheet" href="<?php echo INCLUDE_PATH?>estilos/feed.css">

</head>
<body>

<section class="section-primary" >

    <div class="container-post">

    <div class="icon-post">
      <i class='material-icons'>more_horiz</i>
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






    <div class="content-post" style=" " ><!--INICIO NOTICIAS-->

     
            <div class="usuario d-flex" style="display:flex;  align-items: center;justify-content: space-between;"> <!--INICIO USUARIO-->
                    <div class="usuario-perfil " style="display:flex;  align-items: center;">

                      <a href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> <img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap" style="width: 50px; height: 50px;border-radius: 30px;" > </a>

                      <h6 style="margin-left:10px" ><?php echo @$usuario_resposavel['nome'];?></h6>
                  </div>
                

                     
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                <div class="icon-post">  <!--INICIO menu-->

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

                <div class=" mt-4 mb-4" style="width: 100%;background-color:white;display:flex;">

                
               
                <img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa'] ?>" alt="Card image cap" style="width: 50%; height: 260px;" >      

                  <div class="card-body">

                    <h5 class="card-title"><?php echo $value['titulo'];?></h5>

                    <h6 class="card-subtitle mb-2 text-muted"><?php echo date('d/m/Y',strtotime($value['data']));?></p>
                    
                    <p class="card-text"><?php echo substr($value['conteudo'],0,50).'...';?></p>

                    <a href="<?php echo INCLUDE_PATH; ?>noticia/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>" class="card-link">Link da Noticia</a>
                  </div>
                </div>
      


          </div> <!--FIM NOTICIAS-->
        <?php } ?>

    </section> <!--FIM TOTAL-->


 


        </body>
</html>

<?php }else{
    include('page/noticia_single.php');
} ?>

