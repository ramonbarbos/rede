<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>estilos/login-register.css">

  </head>
  <body>
  
    <div class="container-page">

    
            <div class="content-pagina">

                    <div class="page-1">
                        <div class="img-cont">
                          <img src="<?php echo INCLUDE_PATH ?>img/Facebook-Download-PNG.png" alt="">
                        </div>
                    </div>

                    <div class="page-2">
                        <div class="conteiner-form">
                          
                            <form>
                                  <div class="mb-3">
                                    <h3  >Cadastre-se</h3>
                                <div id="emailHelp" class="form-text">É facil e rapido.</div>
                                  </div>
                                  <div class="line"></div>

                              <!--User-->
                                <div class="mb-3">
                                  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Usuario">
                                </div>
                                 <!--Nome-->
                                 <div class="mb-3">
                                  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Nome">
                                </div>
                                 <!--Sobrenome-->
                                 <div class="mb-3">
                                  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Sobrenome">
                                </div>
                                 <!--Senha-->
                                <div class="mb-3">
                                  <input type="password" class="form-control"  placeholder="Senha">
                                </div>
                                  <!--Imagem-->
                                  <div class="mb-3">
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                  </div>
                                  <!--Botão enviar-->

                                <div class="container-btn">
                                  <button  type="submit" class="btn register">Criar nova conta</button>
                              </div>
                                  <!--Voltar ao Login -->
                             
                                <div class="line"></div>
                                <div class="container-btn">
                                  <a class="esqueceu" href="<?php echo INCLUDE_PATH ?>page/login.php"><span>Ja tenho conta</span></a>

                                </div>
                              </form>

                              
                            
                        </div>
                    </div>

            </div>
            
      </div>


</body>
</html>