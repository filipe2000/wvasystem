<?php
if (!isset($_SESSION['user']) && (!isset($_SESSION['paswd']))) {
  header("Location: index.php?acao=deny");exit();
}//if
  require_once("conect/conect.php");
  require_once("includes/logout.php");
  require_once("model/EntityUser.php");
  $userLog=$_SESSION['user'];
  $passLog=$_SESSION['paswd'];

  $Usuario= new Usuarios();//instanciar classe

  $Usuario->setUsuario($userLog);
  $Usuario->setSenha($passLog)  ;

  $result=$Usuario->Logar();//recebe objeto      
    foreach ($result as $show) {
      $nLog=$show['nome'];      
    }
  
?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar">
        </span><span class="icon-bar"></span> </a>
        <a class="brand" href="home.php">WVA System</a>
      <div class="nav-collapse">  
        <ul class="nav pull-right">
          
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-cog"></i> Opções <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="../">Visualizar Site</a></li>
              <li><a href="home.php?acao=adduser">Adicionar Usuários</a></li>
              <li><a href="javascript:;">Site em Manutenção</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i></i><class="icon-user"></i> <?php echo substr($nLog,0,strpos($nLog, " ")) ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="home.php?acao=edit-user">Perfil</a></li>
              <li><a href="?sair" onClick="return confirm('Deseja sair do sistema?')">Sair</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="pesquisar">
        </form>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="home.php"><i class="icon-dashboard"></i><span>Homepage</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Postagens</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="home.php?acao=show-posts">Visualizar</a></li>
            <li><a href="home.php?acao=cad-postagem">Cadastrar</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span>Usuários</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Visualizar</a></li>
            <li><a href="home.php?acao=adduser">Cadastrar</a></li>
            <li><a href="home.php?acao=edit-user">Editar Perfil</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="icon-globe"></i><span>Manut. Site</span> </a></li>
        <li></li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->