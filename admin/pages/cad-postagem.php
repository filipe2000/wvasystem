<?php
require_once("model/EntityPost.php");
?>
<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
});
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
<?php
if (isset($_POST['cadastrar'])) 
{
  $file=$_FILES['imagem'];
  $name=$file['name'];

  if (!empty($name)) 
 {
  $Post= new Posts();
  $titulo=trim(strip_tags($_POST['titulo']));
  $data=trim(strip_tags($_POST['data']));
  $exibir=trim(strip_tags($_POST['exibir']));
  $descricao=strip_tags($_POST['descricao']);
  //imagem
  $folder= '../upload/post/'; 
  $extensao= @end(explode('.', $name));
  $novoNome=rand().".$extensao";
 
 if (move_uploaded_file( $_FILES['imagem']['tmp_name'], $folder.'/'.$novoNome)) 
    { //registro                  
      try {
      $result= $Post->Insert($titulo, $data, $novoNome, $exibir, $descricao);
      //$row= $result->rowCount();
      if ($result) {
        echo '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Confirmação </strong> Cadastrado no sistema.
              </div>';  
              header("location: home.php?acao=show-posts");exit;          
      }else{
        echo '<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Erro</strong> Erro ao cadastrar.
              </div>';
      }
    } catch (PDOException $e) {
      //echo $e;
    }//registro
    }
 }//empty name
 else
 {
  echo '<script>history.go(-1);
        alert("Insira uma imagem!");
        </script>';
 }    
}// post
?>      
            <div class="span12">	      		
	      		<div id="target-1" class="widget">	

            <div class="widget-header">
                <i class="icon-file"></i>
                <h3>Cadastrar Postagem</h3>
            </div> <!-- /widget-header -->

	      			<div class="widget-content">
                
                <div class="tab-pane" id="formcontrols">


              <form id="edit-profile" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                  
                    
                    <div class="control-group">                     
                      <label class="control-label" for="username">Título:</label>
                      <div class="controls">
                        <input type="text" class="span6 disabled" id="titulo" name="titulo" value="" >
                        
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    
                    
                    <div class="control-group">                     
                      <label class="control-label" for="firstname">Data:</label>
                      <div class="controls">
                        <input type="text" id="date" name="data" value="">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    
                    <div class="control-group ">                     
                      <label class="control-label" for="lastname">Imagem:</label>
                      <div class="controls ">
                        <input type="file" class="span4 imgUp" id="imagem" name="imagem">
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                    
                    <div class="control-group">                     
                      <label class="control-label" for="username">Exibir</label>
                      <div class="controls">
                        <select id="exibir" name="exibir">
                          <option>Sim</option>
                          <option>Não</option>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="email">Descrição:</label>
                      <div class="controls">
                        <textarea class="span7" rows="10" id="descricao" name="descricao"value=""></textarea>
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