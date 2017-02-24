<?php
ob_start();//iniciar sessão
if (isset($_SESSION['user'])) {
  $user= $_SESSION['user'];
  $pass= $_SESSION['paswd']; 
}
require_once('model/EntityUser.php');
?>

<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
<?php
//recupera dados
$User1=new Usuarios(); 
  try {   
    $User1= new Usuarios();//instanciar
    $User1->setUsuario($user);
    $User1->setSenha($pass);
    $result= $User1->Logar();   
    foreach ($result as $show) 
    {
      $id=$show['id'];
      $n=$show['nome'];      
      $e=$show['email'];
      $u=$show['usuario'];
      $s=$show['senha'];
      $f=$show['thumb'];
      $ni=$show['nivel'];     
    }
  } catch (PDOException $e) {    echo $e;  }
if (isset($_POST['salvar'])) 
{  
  $nome=trim(strip_tags($_POST['nome']));
  $email=trim(strip_tags($_POST['email']));
  $senha=trim(strip_tags($_POST['senha']));
  $nivel=$_POST['nivel'];
  //imagem
  $file=$_FILES['imagem'];
  $name=$file['name'];
  $folder= '../upload/user/'; 
  $extensao= @end(explode('.', $name));
  $foto=rand().".$extensao";  
  
  if(empty($name))    
  { //atualizar sem imagem 
   $User2= new Usuarios();
   $UserLog=new Usuarios();
   $result=$User2->UpdateNoImage($nome, $email, $senha, $nivel, $id);
      $row= $result->rowCount();
      if ($row>0) 
      { 
        $UserLog->setSenha($senha);//logar com senha atual
        $UserLog->setUsuario($user);//logar com usuario da session
        $res=$UserLog->Logar();
          if ($res!=null) 
          {
            session_destroy();
            session_unset('user');
            session_unset('pswd');//limpa session da senha  
            session_start();
          $_SESSION['paswd']=$senha;//passa a nova senha para session 
          $_SESSION['user']= $user;    
          }
        echo '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Confirmação - </strong> Atualizado no sistema .
              </div>'; 
              header("location: home.php?acao=show-Usuarios");exit;        
      }else{
        echo '<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Erro - </strong> Erro ao atualizar.
              </div>';
          }
          
  } else
  {//selecionar imagem atual para excluir 
      try {
        $User3= new Usuarios();
        $imgDel=$User3->SelImg($id);               
      } catch (PDOException $e) 
      {   echo $e;  }
    //preparação da nova imagem
    if (move_uploaded_file( $_FILES['imagem']['tmp_name'], $folder.'/'.$foto)) 
    { //update          
        try 
        {  
        $User4=new Usuarios();  
        $result=$User4->Update($nome, $email, $senha, $foto, $nivel, $id);
          $row= $result->rowCount();                  
          if ($row>0)
          {
            $UserLog2=new Usuarios();
            $UserLog2->setSenha($senha);//logar com senha atual
            $UserLog2->setUsuario($user);//logar com usuario da session
            $res=$UserLog2->Logar();
              if ($res!=null) 
              {
                session_destroy();
                session_unset('user');
                session_unset('pswd');//limpa session da senha  
                session_start();
              $_SESSION['paswd']=$senha;//passa a nova senha para session 
              $_SESSION['user']= $user; 
            echo '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Confirmação - </strong> Atualizado no sistema .
                  </div>'; 
                  header("location: home.php?acao=show-Usuarios");
                  //excluindo imagem atual que será substituída
                    $file= "../upload/user/".$imgDel->thumb;
                    unlink($file); exit;          
               }else
              {
            echo '<div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Erro - </strong> Erro ao atualizar.
                  </div>';
              }
        }           
        }catch(PDOException $e){ echo $e;}
    }
  }//else 
 }  
?>
<div class="span12">            
  <div id="target-1" class="widget">
  <div class="widget-header">
      <i class="icon-user"></i>
      <h3>Perfil Usuário - 
      <?php echo $user ?></h3>
  </div> <!--header -->
    <div class="widget-content">                
    <div class="tab-pane" id="formcontrols">

    <form name="frmEditUser" onsubmit="return validaemail(this.email.value)" id="edit-profile" class="form-horizontal" method="post" enctype="multipart/form-data"> 
          
      <div class="control-group">                     
        <label class="control-label" for="username">Nome:</label>
        <div class="controls">
          <input type="text" class="span6 disabled" id="nome" name="nome" 
          value="<?php echo $n; ?>" >                        
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->
      
      <div class="control-group">                     
        <label class="control-label" for="email">Email:</label>
        <div class="controls">
          <input type="text" class="span6" id="email" name="email" value="<?php echo $e; ?>" >                        
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->
      
      <div class="control-group">                     
        <label class="control-label" for="user">Usuario:</label>
        <div class="controls">
          <input type="text" disabled="true" class="span6 disabled" id="usuario" name="usuario" value="<?php echo $u; ?>" >                        
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->

      <div class="control-group">                     
        <label class="control-label" for="passwd">Senha:</label>
        <div class="controls">
          <input type="password" class="span6 disabled" id="senha" name="senha" value="<?php echo $s; ?>" >                        
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->
      
      
      <div class="control-group ">                     
        <label class="control-label" for="lastname">Foto:</label>
        <div class="controls ">                        
          <span class="image"> <img src="../upload/user/<?php echo $f; ?>" /> </span>                        
          <input type="file" class="span4 imgUp" id="imagem" name="imagem">
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->
      
      <div class="control-group">                     
        <label class="control-label" for="nivel">Nivel</label>
        <div class="controls">
          
            <?php
            if ($ni==1) {
        echo ' <select id="nivel" name="nivel">
                <option value="1" selected>Administrador(a)</option>
                <option value="0" >Assistente</option>  </select>';
            }else{//assitente não pode editar
         echo ' <select id="nivel" name="nivel" disabled>
                <option value="1" selected>Administrador(a)</option>
                <option value="0" >Assistente</option>  </select>';
            }
            ?> 
        </div> <!-- /controls -->       
      </div> <!-- /control-group -->      
        <div class="form-actions">
          <input type="submit" name="salvar" value="Salvar" class="btn btn-primary"> 
          <input type="reset" value="Cancelar" class="btn">
      </div> <!-- /form-actions -->
     </form>
     </div> <!-- /formcontrols -->   
    </div> <!-- /widget-content -->
  </div> <!-- /widget -->
</div><!-- span 12 -->
</div><!-- row -->           
    </div>    <!-- /container --> 
  </div>  <!-- /main-inner --> 
</div><!-- /main -->
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<script type="text/javascript">
function validaemail(email)
{
  if (email=="") 
  {
    alert('Campo e-mail nulo');
    return false;
  }else
  {
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
          (dominio.lastIndexOf(".") < dominio.length - 1)) 
        { return true; } 
      else{ alert("E-mail invalido");  
        return false; 
          }    
  }
}
</script>