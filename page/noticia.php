
<?php 
  $url = explode('/',$_GET['url']);
  if(!isset($url[2]))
  {
  $cat = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE slug = ?");
  $cat->execute(array(@$url[1]));
  $cat = $cat->fetch();
    //print_r($cat);
   //$cat['nome'];
?>


<nav class="navbar justify-content-between" style="background-color: #329da8; height: 90px;color:white">

    <div class="container">

        
              <form >
                        <select class="form-control mt-2"  name="categoria">


                        <option value=""  selected="">Todas as categorias</option>

                        <?php
                            $categorias = Painel::selectAll('tb_site.categoria');
                            foreach($categorias as $key => $value) {

                        ?>
                          <option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug'] ?>"><?php echo $value['nome']; ?></option>
                          
                          <?php } ?>
                      
                      
                        </select>

                    </form>

                    
                              


                  <?php 
                      
                      if(@$cat['nome'] ==''){ 
                        echo '<a class="navbar-brand">Feed</a>';
                      }else{
                        echo '<a class="navbar-brand">'.$cat['nome'].'</a>';

                      }
                    
                    ?>

                <form  method="post">
                          <input class="form-control mt-2" type="text" name="parametro" placeholder="O que deseja procurar?" aria-label="Search">
                           
                    </form>



    </div>

</nav>
<a type="button" style="background-color:#329da8;color:white;" class="btn btn-lg btn-block mt-5 mb-5" href="<?php echo INCLUDE_PATH_PAINEL; ?>pages/cadastrar-noticia-feed?adicionar">Adicionar</a>

<?php 
                     $porPagina = 5;

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


<section style="width: 80%; margin:auto; margin-top:30px; height: 100%;">




    <div class="container" style="background-color:white; padding:10px; margin-bottom:50px; " ><!--INICIO NOTICIAS-->

          
          

              
            <div class="usuario d-flex" style="display:flex;  align-items: center;justify-content: space-between;"> <!--INICIO USUARIO-->
                    <div class="usuario-perfil " style="display:flex;  align-items: center;">

                      <a href="<?php echo INCLUDE_PATH; ?>usuario_single?id=<?php echo @$usuario_resposavel['id'];?>"> <img class="card-img-top" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo @$usuario_resposavel['img'];?>" alt="Card image cap" style="width: 50px; height: 50px;border-radius: 30px;" > </a>

                      <h6 style="margin-left:10px" ><?php echo @$usuario_resposavel['nome'];?></h6>
                  </div>
                

                       <!--INICIO menu-->
                  <div class="btn-group dropstart"> 
                        <a class="dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                        <?php if( @$usuario_resposavel['user'] == @$_SESSION['user'] || @$_SESSION['cargo'] == 2) { ?>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL ?>pages/gerenciar-noticia-feed?gerenciar=<?php echo $value['id']; ?>">Editar</a>
                        </div>
                             <?php }else{ ?>
                            
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                 <a class="dropdown-item" href="<?php echo INCLUDE_PATH?>noticia">Editar</a>
                            </div>

                          <?php   }  ?>
                        

                       

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
      


          </div> <!--FIM NOTICIAS-->


    </section> <!--FIM TOTAL-->
    <?php } ?>


      <?php
       $query = "SELECT * FROM `tb_site.noticias` ";
        if(@$cat['nome'] !=''){
          $cat['id'] = (int)$cat['id'];
          $query.="WHERE categoria_id = $cat[id]";

        }
        $totalPaginas =  MySql::conectar()->prepare($query);
        $totalPaginas->execute();
        $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
      ?>


    <div class="container " style="display:flex; justify-content: center;">
      <ul class="pagination">
        <?php

        if(!isset($_POST['parametro'])){

            for($i = 1; $i <= $totalPaginas; $i++){
              $catStr = (@$cat['nome'] != '') ? '/'.$cat['slug'] : '';
              if($pagina == $i )
                echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'noticia'.$catStr.'?pagina='.$i.'">'.$i.'</a></li>';
              else
                echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'noticia'.$catStr.'?pagina='.$i.'">'.$i.'</a></li>';
            }

        }

        
        ?>


      </ul>
        </div>
        

<?php }else{
    include('page/noticia_single.php');
} ?>