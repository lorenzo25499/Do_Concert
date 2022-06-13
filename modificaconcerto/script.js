function validaForm(){
    var codice=parseInt(document.myForm.codice.value);
    if(isNaN(codice)){
        alert("Il codice deve essere un numero!");
        return false;
    }

    var artista=parseInt(document.myForm.artista.value);
    if(!isNaN(artista)){
        alert("L' artista non può essere un numero!");
        return false;
    }

    var citta=parseInt(document.myForm.citta.value);
    if(!isNaN(citta)){
        alert("La città non può essere un numero!");
        return false;
    }

    var luogo=parseInt(document.myForm.luogo.value);
    if(!isNaN(luogo)){
        alert("il luogo non può essere un numero!");
        return false;
    }
    var cap=parseInt(document.myForm.maxspettatori.value);
    if(cap){
        if(isNaN(cap)){
            alert("La capienza massimae essere un numero!");
            return false;
        }
    }

    var cap=parseInt(document.myForm.postidisponibili.value);
    if(cap){
        if(isNaN(cap)){
            alert("Il numero di posti disponibili deve essere un numero!");
            return false;
        }
    }
    
    var prezzo=parseInt(document.myForm.prezzo.value);
    if(prezzo){
        if(isNaN(prezzo)){
            alert("Il prezzo deve essere un numero!");
            return false;
        }
    }
   
}