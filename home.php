<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Postagem com PHP PDO</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/estilo.css" rel="stylesheet" type="text/css" media="all"/>
<link href="admin/css/estilo.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="admin/js/valid.js"></script> 
	<script type="text/javascript">
//------------------------------------	
	$(function(){//reduzir texto
		$("#imgid").mouseover(function()//evento passar o mouse sobre
		{	
			$("#cont").removeClass();//remove a classe existente
			$("#cont").addClass("contMin");//acidiona classe			
		});	
	});
	$(function(){//aumentar texto
		$("#imgid").mouseout(function()//evento tirar o mouse sobre
		{	
		$("#cont").removeClass();//remove a classe existente	
		$("#cont").addClass("content");//acidiona classe
		});	
	});
//--------------------------------------
	</script>
</head>
<body >

</div>
<div class="divcenter">
	<ul class="boxposts">
		<li>
			<span class="image"> 
				<a href="#" id="imgid"><img src="imagens/java.jpg">	</a>
			</span>
			<div id="cont" class="content">
				<h1 id="idh1"> Titulo da noticia</h1>
				<p id="idp">
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna 
				aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut 
				aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, 
				vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui...
				</p><a href="" id="idleia">Leia artigo completo...	</a>
				<div id="footer_post">					
					<span id="dtpost">Data: 00/00/000</span>
				</div>
			</div>
		</li>
	</ul>
</div>


</body>
</html>
