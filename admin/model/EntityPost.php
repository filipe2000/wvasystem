<?php 
//include('conect/conect.php');
class Posts extends Conexao
{
	protected $table='tb_postagem';
	private $id;
	private $titulo;
	private $data;
	private $imagem;
	private $exibir;
	private $descricao;

	public function setId($id)
	{
		$this->id=$id;
	}
		public function getId()
		{
			return $this->id;	
		}
	public function setTitulo($titulo)
	{
		$this->titulo=$titulo;
	}
		public function getTitulo()
		{
			return $this->titulo;	
		}
	public function setData($data)
	{
		$this->data=$data;
	}
		public function getData()
		{
			return $this->data;	
		}
	public function setImagem($imagem)
	{
		$this->imagem=$imagem;
	}
		public function getImagem()
		{
			return $this->imagem;	
		}
	public function setExibir($exibir)
	{
		$this->exibir=$exibir;
	}
		public function getExibir()
		{
			return $this->exibir;	
		}
	public function setDescricao($descricao)
	{
		$this->descricao=$descricao;
	}
		public function getDescricao()
		{
			return $this->descricao;	
		}

	public function Insert($t,$dt,$img, $e, $de)
	{
		try {
			$sql="insert into ".$this->table."(titulo,data,imagem,exibir,descricao)values (:t, :d, :i, :e, :de)";
		$stmt=	Conexao::prepare($sql);
		$stmt->bindParam(':t',$t);
		$stmt->bindParam(':d',$dt);
		$stmt->bindParam(':i',$img);
		$stmt->bindParam(':e',$e);
		$stmt->bindParam(':de',$de);
		$result=$stmt->execute();		
		return $result;
		} catch (PDOException $e) {
			echo $e;
		}
	}
	public function NumRows()
	{
		try {
			$sql="select * from ".$this->table;
			$stmt=	Conexao::prepare($sql);									
			$stmt->execute();
			$log=$stmt->fetchAll();	
			$rows=$stmt->rowCount();								
			return $rows;
		} catch (PDOException $e) {
			echo $e;
		}
	}	
	
	public function SelPost($id)
	{
		try {
			$sql="select * from ".$this->table." where id = :id";
			$stmt=	Conexao::prepare($sql);	
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);							
			$stmt->execute();
			$log=$stmt;									
			return $log;
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function SelImg($id)
	{
		try {
			$sql="select imagem from ".$this->table." where id = :id";
			$stmt=	Conexao::prepare($sql);	
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);							
			$stmt->execute();
			$imgDel=$stmt->fetch(PDO::FETCH_OBJ);										
			return $imgDel;
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function SelPag($ini,$fim)
	{
		try {
			$sql="select * from ".$this->table." order by id desc limit :ini , :fim";
			$stmt=	Conexao::prepare($sql);	
			$stmt->bindParam(':ini',$ini,PDO::PARAM_INT);
			$stmt->bindParam(':fim',$fim,PDO::PARAM_INT);					
			$stmt->execute();
			$log=$stmt->fetchAll();									
			return $log;
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function Update($t, $dt, $img, $e, $d,$id)
	{
		 $sql = "update ".$this->table." set titulo= :titulo,data= :data,imagem= :imagem, exibir= :exibir,descricao= :descricao where id= :id";
                try {  
                  $stmt=	Conexao::prepare($sql);                    
                  $stmt->bindParam(':titulo', $t, PDO::PARAM_STR);
                  $stmt->bindParam(':data', $dt, PDO::PARAM_STR); 
                  $stmt->bindParam(':imagem', $img, PDO::PARAM_STR);               
                  $stmt->bindParam(':exibir', $e, PDO::PARAM_STR);     
                  $stmt->bindParam(':descricao', $d, PDO::PARAM_STR); 
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
                  $stmt->execute();
                  return $stmt;
                  } catch (PDOException $e) {
					echo $e;
				  }
	}

	public function UpdateNoImage($t, $dt, $e, $d,$id)
	{
		 $sql = "update ".$this->table." set titulo= :titulo,data= :data,exibir= :exibir,descricao= :descricao where id= :id";
                try {  
                  $stmt=Conexao::prepare($sql);                  
                  $stmt->bindParam(':titulo', $t, PDO::PARAM_STR);
                  $stmt->bindParam(':data', $dt, PDO::PARAM_STR);                    
                  $stmt->bindParam(':exibir', $e, PDO::PARAM_STR);     
                  $stmt->bindParam(':descricao', $d, PDO::PARAM_STR); 
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
                  $stmt->execute();
                  return $stmt;
                  } catch (PDOException $e) {
					echo $e;
				  }
	}
	public function DelPost($id)
	{
		try {
			$sql="delete from ".$this->table." where id = :id";
			$stmt=	Conexao::prepare($sql);	
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);							
			$stmt->execute();												
			return $stmt;
		} catch (PDOException $e) {
			echo $e;
		}
	}
	public function limitarTexto($texto, $limite)
	{
	$contador=strlen($texto);
	if ($contador>= $limite) 
		{
		$texto=substr($texto,0,strrpos(substr($texto,0, $limite),' ')).'...';
		return $texto;
		}
	}
}
 ?>