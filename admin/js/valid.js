function validaemail(email){
  if (email=="") {
    alert('Campo e-mail nulo');
    return false;
  }else{
    usuario = email.substring(0, email.indexOf("@")); 
    dominio = email.substring(email.indexOf("@")+ 1, email.length); 
      if ((usuario.length >=5) && 
          (dominio.length >=5) && 
          (usuario.search("@")==-1) && 
          (dominio.search("@")==-1) && 
          (usuario.search(" ")==-1) && 
          (dominio.search(" ")==-1) && 
          (dominio.search(".")!=-1) && 
          (dominio.indexOf(".") >=1)&& 
          (dominio.lastIndexOf(".") < dominio.length - 1)) { 
        
        return true;
      } else{
        alert("E-mail invalido");  
        return false; 
        }    
  }

}

function val(){
  alert("Validação");
}

