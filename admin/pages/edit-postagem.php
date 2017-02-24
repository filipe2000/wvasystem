<?php
require_once("model/EntityPost.php");
?>
<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
//   $("#phone").mask("(999) 999-9999");
//   $("#tin").mask("99-9999999");
//   $("#ssn").mask("999-99-9999");
});
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
<?php
//recupera dados
if (!isset($_GET['id'])) {
  header("location: home.php?acao=show-posts");exit;
}
$id=$_GET['id'];
$Post= new Posts();
  try {   
    $result=$Post->SelPost($id);
    $row= $result->rowCount();
    if ($row>0) {
         while ($show = $result->FETCH(PDO::FETCH_OBJ)) {
          $id=$show->id;
          $titulo=$show->titulo;
          $data=$show->data;
          $imagem=$show->imagem;
          $exibir=$show->exibir;
          $descricao=$show->descricao;
         }
    }else{
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Eviso</strong> Registro não encontrado.
            </div>';exit;
          }
  } catch (PDOException $e) {
    echo $e;
  }//try
  //formulário receberá primeiro os valores
 ?> 
<div class="span12">            
    <div id="target-1" class="widget">
      <div class="widget-header">
        <i class="icon-file"></i>
        <h3>Editar Postagem</h3>
      </div> <!-- /widget-header -->
      <div class="widget-content">                
        <div class="tab-pane" id="formcontrols">
      <form id="edit-profile" name="form-edit" class="form-horizontal" action="" method="post" 
      enctype="multipart/form-data">
          <div class="control-group">                     
              <label class="control-label" for="username">Título:</label>
              <div class="controls">
                <input type="text" class="span6 disabled" id="titulo" name="titulo" 
                value="<?php echo $titulo; ?>" >                        
              </div> <!-- /controls -->       
            </div> <!-- /control-group --> 
            <div class="control-group">                     
              <label class="control-label" for="firstname">Data:</label>
              <div class="controls">
                <input type="text" id="date" name="data" 
                value="<?php echo $data; ?>">
              </div> <!-- /controls -->       
            </div> <!-- /control-group -->
            <div class="control-group ">                     
              <label class="control-label" for="lastname">Imagem:</label>
              <div class="controls ">                        
                <span class="image"> <img src="../upload/post/<?php echo $imagem; ?>" /> </span>
                <input type="file" class="span4 imgUp" id="imagem" name="imagem">
              </div> <!-- /controls -->       
            </div> <!-- /control-group -->
            <div class="control-group">                     
              <label class="control-label" for="username">Exibir</label>
              <div class="controls">
                <select id="exibir" name="exibir">
              <?php
                  if ($exibir=='Sim') {
                    echo "<option selected>Sim</option>";
                    echo "<option>Não</option>";
                  }else{
                    echo "<option >Sim</option>";
                    echo "<option selected>Não</option>";
                  }
              ?>               
                  
                </select>
              </div> <!-- /controls -->       
            </div> <!-- /control-group -->

            <div class="control-group">                     
              <label class="control-label" for="email">Descrição:</label>
              <div class="controls">
                <textarea class="span7" rows="10" id="descricao" name="descricao" value="">
                <?php echo $descricao; ?></textarea>
              </div> <!-- /controls -->       
            </div> <!-- /control-group -->
            <div class="form-actions">
                <input type="submit" name="atualizar" value="Atualizar" class="btn btn-primary"> 
                <input type="reset" value="Cancelar" class="btn">
            </div> <!-- /form-actions -->                   
         </form>
         </div> <!-- /formcontrols -->
      </div> <!-- /widget-content -->
    </div> <!-- /widget -->
</div><!-- span 12 -->
    </div><!-- row -->          
    </div><!-- /container --> 
  </div> <!-- /main-inner --> 
</div>
<!-- /main -->
<?php 
if (isset($_POST['atualizar'])) 
{  
  $titulo=trim(strip_tags($_POST['titulo']));
  $data=trim(strip_tags($_POST['data']));
  $exibir=trim(strip_tags($_POST['exibir']));
  $descricao=$_POST['descricao'];
  //imagem
  $file=$_FILES['imagem'];
  $folder= '../upload/post/';         
  $name=$file['name'];
  $extensao= @end(explode('.', $name));
  $novoNome=rand().".$extensao";
 
  
  if (empty($name))   
  { //atualizar sem imagem
   $Post2= new Posts();
   $result=$Post2->UpdateNoImage($titulo, $data, $exibir, $descricao,$id);
      $row= $result->rowCount();
      if ($row>0) 
      {
        echo '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Confirmação - </strong> Atualizado no sistema .
              </div>'; 
              header("location: home.php?acao=show-posts");exit;        
      }else{
        echo '<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Erro - </strong> Erro ao atualizar.
              </div>';
          }
  } else
  {//selecionar imagem atual para excluir            
      try 
      {
        $Post3= new Posts();
        $imgDel=$Post3->SelImg($id);               
      } catch (PDOException $e) 
      {   echo $e;  }
    //preparação da nova imagem
    if (move_uploaded_file( $_FILES['imagem']['tmp_name'], $folder.'/'.$novoNome)) 
    { //update          
        try 
        {  
        $Post4=new Posts();  
        $result=$Post4->Update($titulo, $data,$novoNome ,$exibir, $descricao,$id);
          $row= $result->rowCount();                  
          if ($row>0)
          {
            echo '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Confirmação - </strong> Atualizado no sistema .
                  </div>'; 
                  header("location: home.php?acao=show-posts");
                  //excluindo imagem atual que será substituída
                    $file= "../upload/post/".$imgDel->imagem;
                    unlink($file); exit;          
          }else
          {
            echo '<div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Erro - </strong> Erro ao atualizar.
                  </div>';
          }
        } catch (PDOException $e) 
        {  echo $e;   }
          //registro
    }else
      echo "Desculpe, ocoreu algum erro";
          
  }//else
}       


?>

<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>