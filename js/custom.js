
//CONSULTANDO FEED INDIVIDUAL
async function listFeed(id){
    console.log("Envido: " +id)
    const dados = await fetch("./class/consultaFeed.php?id=" + id) //enviar
    const resposta = await dados.json(); //receber
    console.log(resposta)

    if(resposta['erro']){
        document.getElementById('msgAlerta').innerHTML = resposta['msg'];
    }else{

        

        //Feed
       
        document.getElementById('conteudoFeed').innerHTML = resposta['dados-feed'].conteudo;
        document.getElementById('capaFeed').innerHTML = '<img class="" src="./painel/uploads/'+ resposta['dados-feed'].capa +' " alt="Card image cap"  >' ; 
        document.getElementById('dataFeed').innerHTML = resposta['dados-feed'].data;

        //User
        document.getElementById('nomeUser').innerHTML = resposta['dados-res'].nome;
        document.getElementById('imgUser').innerHTML = '<img class="" src="./painel/uploads/'+resposta['dados-res'].img +' " alt="Card image cap"  >' ; 
        


        //INSERINDO COMENTARIOS NA PUBLICAÇÃO
        const cadForm = document.getElementById("cad-comentario-form");

        cadForm.addEventListener("submit", async (e) =>{
            e.preventDefault(); //para não recarrecar a pagina
            console.log("chegou")

            const dadosForm =  new FormData(cadForm);
            dadosForm.append("add", 1)
            dadosForm.append("id_noticia" , id)
            console.log(dadosForm)

            const dadosComentario = await fetch("./class/cadastrarComentario.php",{
                method: "POST",
                body:dadosForm
            });

            const respostaComentario = await dadosComentario.json();
            console.log(respostaComentario);

        })

    }
}

