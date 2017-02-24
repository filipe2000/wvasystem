<head>
<script type="text/javascript" src="js/valid.js"></script>
</head>
<?php 
ob_start();//iniciar sessão
session_start();//iniciar sessão
  //se não existir sessão user e pswd, vai para index
if (!isset($_SESSION['user'])&& !isset($_SESSION['paswd'])) {
  header("Location: index.php?acao=deny");exit();
}
include("includes/logout.php");
include("includes/header.php"); 

?>

<body>
<?php 
include("includes/topo.php"); 
  if (isset($_GET['acao'])) {
    $acao= $_GET['acao'];
    switch ($acao) {
      case 'adduser':
          include("pages/cad-user.php");
          break;
        case 'accept':
          include("pages/inicio.php");
          break;
        case 'cad-postagem':
          include("pages/cad-postagem.php");
          break;
        case 'show-posts':
          include("pages/show-posts.php");
          break;
        case 'edit-postagem':
          include("pages/edit-postagem.php");
          break; 
        case 'edit-user':
          include("pages/edit-user.php");
          break;  
      default:
        include("pages/inicio.php");
        break;
    }//switch      
         
  }else{
    
    include("pages/inicio.php");
  }
?>

<?php include("includes/footer.php"); ?>
</body>
</html>
