<?php
include("model/EntityPost.php");
//include("function/limita-texto.php");
?>
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">
            <div class="span12">
              <?php
              if (isset($_GET['acao'])) 
              {                
                $acao=$_GET['acao'];
                  if ($acao=='deny') 
                  {
              echo '
               <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Acesso negado</strong> Não está logado.
               </div>';               
                  }
              }
              //deletar
              if (isset($_GET['del'])) 
              {
                $idel=$_GET['del'];
                $PostDel=new Posts();
                $ImgDel=new Posts();                     
                     try 
                     {
                      $img=$ImgDel->SelImg($idel);
                      $result=$PostDel->DelPost($idel);  
                     } 
                     catch (Exception $e) { echo $e; }
                $contar=$result->rowCount();
                if ($contar>0) 
                {
                  echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Confirmação - </strong> Excluído no sistema.
                        </div>'; 
                        $file="../upload/post/".$img->imagem;
                        //apagar arquivo
                        unlink($file);                                           
                }else
                {
                  echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Erro - </strong> Não foi possível excluiro post..
                    </div>';
                  }                            
              }      
                         
              ?>
      		</div>
            
            
            <div class="span12">	      		
	      		<div id="target-1" class="widget">	      			
	      			<div class="widget-content">	      				
			      		<h1>WVA System - Apresentação</h1>			      		
			      		<p>O <strong>WVA System</strong> é um Sistema de Postagem desenvolvido pelo canal '<strong>Web Vídeo Aulas</strong>', cujo objetivo é gerenciar toda parte de postagens e
                        algumas funções internas do próprio sistema.
                        
		      		</div> <!-- /widget-content -->
	      		</div> <!-- /widget -->
      		</div><!-- span 12 -->
            
            
    </div><!-- row -->        
     
        
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Últimos Posts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nº</th>
                    <th> Imagem</th>
                    <th> Título</th>
                    <th> Data</th>
                    <th> Resumo</th>                    
                  </tr>
                </thead>
                <tbody>


<?php
$Post= new Posts();//instanciar classe
try 
{
$result=$Post->SelPag(0,5); 
    if ($result!=null) 
    {
      foreach ($result as $show) 
      {
        //repete a linha de resultado, html
     ?>      
                  <tr>
                    <td class="post"> <?php echo $show['id']; ?></td>
                    <td class="post"> 
                    <span class="image"> 
                    <img src="../upload/post/<?php echo $show['imagem']; ?>" /> 
                    </span>
                    </td>
                    <td class="post"> <?php echo $show['titulo']; ?> </td>
                    <td class="post"> <?php echo $show['data']; ?> </td>
                    <td class="post"> 
                      <?php
                      if (strlen($show['descricao'])<250) 
                      {
                         echo $show['descricao']; 
                       } 
                      echo $Post->limitarTexto($show['descricao'],250); 
                      ?> 
                    </td>
                    <td class="td-actions">
                      <a href="home.php?acao=edit-postagem&id=<?php echo $show['id']; ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"> </i></a>
                      <a href="home.php?acao=accept&del=<?php echo $show['id']; ?>" onclick="return confirm('Confirmar exclusão de registro?');" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
                  </tr>
      <?php
       }//finaliza a repetição
                
    }else
    {
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Eviso</strong> Não há postagens cadastradas.
            </div>';
    }
  } catch (PDOException $e) 
  {
    echo $e;
  }


?>           
                  
                
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
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