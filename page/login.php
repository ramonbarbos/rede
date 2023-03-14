<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>estilos/login-register.css">

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
                                  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Email ou Telefone">
                                </div>
                                <div class="mb-3">
                                  <input type="password" class="form-control"  placeholder="Senha">
                                </div>
                                <div class="mb-3">
                                <button  type="submit" class="btn login">Entrar</button>
                                </div>
                                <div class="mb-3">
                                    <a class="esqueceu" href="#"><span>Esqueceu a senha?</span></a>
                                </div>

                                <div class="line"></div>
                                <div class="container-btn">
                                    <a   href="<?php echo INCLUDE_PATH; ?>page/register.php" class="btn register">Criar nova conta</a>
                                </div>
                              </form>

                              
                            
                        </div>
                    </div>

            </div>
            
      </div>


</body>
</html>