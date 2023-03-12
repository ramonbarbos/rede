
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
        
    }
}