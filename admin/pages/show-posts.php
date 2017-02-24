<?php
require_once("model/EntityPost.php");
?>
<div class="main">
  <div class="main-inner">
    <div class="container">
     <div class="row">    
              <div class="span12">
            <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Postagens</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nº</th>
                    <th> Imagem</th>
                    <th> Título  </th>
                    <th> Data</th>
                    <th> Exibir</th>
                    <th> Descrição</th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>

  <?php
$Post= new Posts();//instanciar
include("function/limita-texto.php");
//paginação
if (empty($_GET['pg'])) {
  
}else{
  $pg=$_GET['pg'];
  //verificar se é numero informado na URL, senão da erro inesperado
    if (!is_numeric($pg)) {
      echo '<script language="javascript">
                  location.href="home.php?acao=show-posts";
                 </script> ';
    }
}



if (isset($pg)) {
  $pg=$_GET['pg'];  
}
else{
   $pg=1;
}
$qtd=5;// nº de registros exibidos
$inicio=($pg*$qtd)-$qtd;

//$select = "select * from tb_postagem limit $inicio, $qtd";//
  try {   //variável do conect vai preparar a variável select, sendo PDO, proteje Sql inject
    $result=$Post->SelPag($inicio,$qtd);

    if ($result !=null) {
      foreach ($result as $show) {
        //repete a linha de resultado, html
  ?>
                  <tr>
                    <td class="post"> <?php echo $show['id']; ?></td>
                    <td ><span class="image"> <img src="../upload/post/<?php echo $show['imagem']; ?>" /> </span></td>
                    <td class="post"> <?php echo $show['titulo']; ?> </td>
                    <td class="post"> <?php echo $show['data']; ?> </td>
                    <td class="post"> <?php echo $show['exibir']; ?> </td>                    
                    <td class="post"> <?php 
                      if (strlen($show['descricao'] )<= 250) {
                        echo $show['descricao'];
                      }else{
                          echo limitarTexto($show['descricao'],250); 
                            }
                          ?>   </td>
                    <td class="td-actions">
                    <a href="home.php?acao=edit-postagem&id=<?php echo $show['id']; ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-edit"> </i></a>
                    <a href="home.php?acao=accept&del=<?php echo $show['id']; ?>" onclick="return confirm('Confirmar exclusão de registro?');" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
                    </td>
                  </tr>
<?php
       }//finaliza a repetição
                
    }else{
      echo '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Eviso</strong> Não há postagens cadastradas.
            </div>';
    }
  } catch (PDOException $e) {
    echo $e;
  }


?>           
                  
                
                </tbody>
              </table>
            </div><!-- /widget-content --> 

            <!-- paginação -->
<style>

.paginas{
  width: 100%;
  height: auto;
  margin: 10px auto;
  padding: 10px auto;
  text-align: center;
  background: #fff;
}
.paginas a{
  width: auto;
  padding: 4px 10px;
  background: #ccc;
  color: #333;
  margin: 0px 2px;
  border-radius: 5px;
  
}
.paginas a:hover{
  box-shadow: 1px 1px 10px #999;
}       /* pegar numero da página exibida*/
        <?php
        if (isset($_GET['pg'])) {
          $num_pg=$_GET['pg'];
        }else{
          $num_pg=1;
        }
        ?>/* passa o numero da pagina para gerar o ativoX */
.paginas a.ativo<?php echo $num_pg ?>{
  background: #00BA8B;
  }

</style>
<?php
 try { 
    $row=$Post->NumRows();    
  } catch (PDOException $e) { 
    echo $e;
  }
if ($row>$qtd) 
{       
    $paginas= ceil($row/$qtd);//arredondar acima
    //verificar se usuario digitar na URL o numero da pagina maior do total
    if ($pg > $paginas) {
      echo '<script language="javascript">
              location.href="home.php?acao=show-posts";
             </script> ';
    }
    $links=3;//num de exibição dos botões
    
    if (!isset($i)) 
    {
      $i='1';
    }
      
?>

<div class="paginas">
    <a href="home.php?acao=show-posts&pg=1"><< - </a>
  

  <?php
      if (isset($_GET['pg'])) 
        {
        $num_pg=$_GET['pg'];
        }
    for ($i=$pg-$links; $i <= $pg -1 ; $i++)
    { 
      if ($i>0) 
      {
  ?>

      <a href="home.php?acao=show-posts&pg=<?php echo $i; ?>" class="ativo<?php echo $i; ?>">
          <?php echo $i; ?>
      </a>
<?php        
      }//if  
    } //for 
?>

    <a href="#" class="ativo<?php echo $i; ?>"><?php  echo $pg; ?></a>
  <?php 
    for ($i=$pg+1; $i<= $pg+$links ; $i++) 
    { 
      if ($i<=$paginas) 
      {
  ?>
        <a href="home.php?acao=show-posts&pg=<?php echo $i;?>" class="ativo<?php echo $i; ?>"><?php echo $i;?></a>
<?php 
      }//if        
    }//for

}//if $row>$qtd
?>
<a href="home.php?acao=show-posts&pg=<?php echo $paginas;?>" class="ativo<?php echo $i; ?>">->></a>

</div><!-- paginas -->
          </div>          <!-- /widget -->
      		</div><!-- span 12 --> 
    </div><!-- row -->  
          </div>          <!-- /widget -->
        </div>        <!-- /span6 --> 
      </div>      <!-- /row --> 
    </div>    <!-- /container --> 
  </div>  <!-- /main-inner --> 
</div><!-- /main -->
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>