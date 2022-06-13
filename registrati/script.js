function validaForm(){
    if(document.myForm.password1.value != document.myForm.ripetipassword.value){
        alert("Password sbagliata!");        
        return false;
    }
    var nome= parseInt(document.myForm.nome.value);
    if(!isNaN(nome)){
        alert("Il nome non può essere un numero! ");
        return false;
    }
    var cognome= parseInt(document.myForm.cognome.value);
    if(!isNaN(cognome)){
        alert("Il cognome non può essere un numero! ");
        return false;
    }
 
}
