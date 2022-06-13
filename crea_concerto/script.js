function validaForm(){
    var code = parseInt(document.myForm.codice.value);
    if(isNaN(code)){
        alert("Il codice deve essere un numero! ");
        return false;
    }
    if(DocumentTimeline.myFormo.codice.value!=7){
        alert("Il codice deve essere composto da 7 cifre!")
        return false;
    }
    var artista = parseInt(document.myForm.artista.value);
    if(!isNaN(artista)){
        alert("Il nome dell'artista non deve essere un numero! ");
        return false;
    }
    var capmax = parseInt(document.myForm.maxspettatori.value);
    if(isNaN(capmax)){
        alert("La capienza massima deve essere un numero! ");
        return false;
    }
    var price = parseInt(document.myForm.prezzo.value);
    if(isNaN(price)){
        alert("Il prezzo deve essere un numero! ");
        return false;
    }
}