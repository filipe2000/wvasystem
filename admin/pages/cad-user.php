<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
<?php
require_once('model/EntityUser.php');
if (isset($_POST['cadastrar'])) 
  {
  //echo "Cadastrou";
  $n=trim(strip_tags($_POST['nome']));
  $email=trim(strip_tags($_POST['email']));
  $usuario=trim(strip_tags($_POST['usuario']));
  $senha=trim(strip_tags($_POST['senha']));  
  $nivel=$_POST['nivel'];

  $User= new Usuarios();//instanciar
  $User->setNome($n);
  $User->setEmail($email);
  $User->setUsuario($usuario);
  $User->setSenha($senha);
  $User->setNivel($nivel);
   //imagem
  $file=$_FILES['imagem'];
  $name=$file['name'];
  $folder= '../upload/user/'; 
  $extensao= @end(explode('.', $name));
  $foto=rand().".$extensao";  
       if (move_uploaded_file( $_FILES['imagem']['tmp_name'], $folder.'/'.$foto)) 
      {
        $User->setFoto($foto);       
      try 
      {   
        $result = $User->Insert();                  
        if ($result) 
        {
          echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Confirmação- </strong> Cadastrado no sistema.
                </div>'; 
                header("location: home.php?acao=show-posts");exit;         
        }else
        { echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erro-</strong> Erro ao cadastrar.
                </div>';
        }
      } catch (PDOException $e) {  echo $e;   }
        //registro
      }
  }
?>
            <div class="span12">	      		
	      		<div id="target-1" class="widget">
            <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Cadastrar Usuário</h3>
            </div> <!-- /widget-header -->
	      			<div class="widget-content">                
                <div class="tab-pane" id="formcontrols">

              <form name="frmCadUser" onsubmit="return validaemail(this.email.value)" id="edit-profile" class="form-horizontal" method="post" enctype="multipart/form-data"> 
                    
                    <div class="control-group">                     
                      <label class="control-label" for="username">Nome:</label>
                      <div class="controls">
                        <input type="text" class="span6 disabled" id="nome" name="nome" value="" >                        
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="email">Email:</label>
                      <div class="controls">
                        <input type="text" class="span6" id="email" name="email" value="" >                        
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="user">Usuario:</label>
                      <div class="controls">
                        <input type="text" class="span6 disabled" id="usuario" name="usuario" value="" >                        
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="passwd">Senha:</label>
                      <div class="controls">
                        <input type="password" class="span6 disabled" id="senha" name="senha" value="" >                        
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    
                    <div class="control-group ">                     
                      <label class="control-label" for="lastname">Foto:</label>
                      <div class="controls ">
                        <input type="file" class="span4 imgUp" id="imagem" name="imagem">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="nivel">Nivel</label>
                      <div class="controls">
                        <select id="nivel" name="nivel">
                          <option value="1">Administrador(a)</option>
                          <option value="0">Assistente</option>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                      <div class="form-actions">
                        <input type="submit" name="cadastrar" value="Salvar" class="btn btn-primary"> 
                        <input type="reset" value="Cancelar" class="btn">
                    </div> <!-- /form-actions -->
                   </div> <!-- /formcontrols -->
                 </form>

                


		      		</div> <!-- /widget-content -->
	      		</div> <!-- /widget -->
      		</div><!-- span 12 -->
            
            
    </div><!-- row -->        
     
        
         
          </div>
          <!-- /widget --> 
          
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>