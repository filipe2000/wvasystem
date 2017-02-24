
<!DOCTYPE html>
<html lang="pt-br">  
<head>
    <meta charset="utf-8">
    <title>Login - WVA System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">     
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">    
    <link href="css/pages/signin.css" rel="stylesheet" type="text/css">
    
</head>
	<?php 
    require_once("conect/conect.php");  //importando conection
    require_once("model/EntityUser.php");//importando classes    
 	?>
<body>	
	<div class="navbar navbar-fixed-top">	
	<div class="navbar-inner">		
		<div class="container">			
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>			
			<a class="brand" href="index.html">
				Login - WVA System			
			</a>					
			<div class="nav-collapse">
				<ul class="nav pull-right">				
					<li class="">						
						<a href="lembrar.php" class="">
							Esqueceu sua senha?
						</a>						
					</li>					
					<li class="">						
						<a href="home.php?acao=adduser">Cadastrar</a>				
					</li>
				</ul>				
			</div><!--/.nav-collapse -->		
		</div> <!-- /container -->		
	</div> <!-- /navbar-inner -->	
</div> <!-- /navbar -->
<div class="account-container">	

	
<?php
ob_start();//iniciar sessão
session_start();//iniciar sessão
	//se existir sessão user e pswd, manterá em home
$Usuario= new Usuarios();//instanciar classe

if (isset($_SESSION['user'])&& isset($_SESSION['paswd'])) {
	header("Location: home.php");exit();
}

if (isset($_GET['acao'])) {//1
	if(!isset($_POST['logar'])){//2
	$acao=$_GET['acao'];
	if ($acao=='deny') {//3
		echo '<div class="alert alert-danger">
		      <button type="button" class="close" data-dismiss="alert">&times;</button>
		      <strong>Acesso negado</strong> Não está logado.
		      </div>';
	}//3
	}//2
}//1
if (isset($_POST['logar'])) {
				//strip_tags , para retirar tags, comandos, do campo digitado, protegendo contra haker.
	$u=trim(strip_tags($_POST['usuario']));
	$s=trim(strip_tags($_POST['senha']));

	$Usuario->setUsuario($u);
	$Usuario->setSenha($s)	;
	try {
		$result=$Usuario->	Logar();//recebe objeto
		
		if ($result!=null) {
			$_SESSION['user']=$u;//cria sessão user com valor $usuario
			$_SESSION['paswd']=$s;
			header("Refresh: 2, home.php?acao=accept");//recarrega em 2seg e direcionar para home

			echo '<div class="alert alert-success">
			      <button type="button" class="close" data-dismiss="alert">&times;</button>
			      <strong>Logado com sucesso!</strong> Acessando o sistema.
			      </div>';			      
		}else{
			echo '<div class="alert alert-danger">
			      <button type="button" class="close" data-dismiss="alert">&times;</button>
			      <strong>Erro no login</strong> Dados incorretos.
			      </div>';
		}
	} catch (PDOException $e) {
		echo $e;
	}
}
?>

	<div class="content clearfix">		
		<form action="#" method="post" enctype="multipart/form-data">		
			<h1>Faça seu Login</h1>					
			<div class="login-fields">				
				<p>Entre com seus dados:</p>				
				<div class="field">
					<label for="username">Usuário</label>
					<input type="text" id="username" name="usuario" value="" placeholder="Usuário" class="login username-field" />
				</div> <!-- /field -->				
				<div class="field">
					<label for="password">Senha:</label>
					<input type="password" id="password" name="senha" value="" placeholder="Senha" class="login password-field"/>
				</div> <!-- /password -->				
			</div> <!-- /login-fields -->			
			<div class="login-actions">									
				<input type="submit" name="logar" value="Entrar no Sistema" class="button btn btn-success btn-large">				
			</div> <!-- .actions -->
		</form>		
	</div> <!-- /content -->	
</div> <!-- /account-container -->

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/signin.js"></script>
</body>

</html>
