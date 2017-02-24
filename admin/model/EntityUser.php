<?php 
//include('conect/conect.php');
class Usuarios extends Conexao
{	protected $table='tblogin';
	private $nome;
	private $email;
	private $usuario;
	private $senha;
	private $foto;
	private $nivel;

	public function setNome($n)
	{
		$this->nome=$n;
	}
		public function getNome()
		{
			return $this->nome;	
		}
	public function setEmail($e)
	{
		$this->email=$e;
	}
		public function getEmail()
		{
			return $this->email;	
		}
	public function setUsuario($u)
	{
		$this->usuario=$u;
	}
		public function getUsuario()
		{
			return $this->usuario;	
		}
	public function setSenha($s)
	{
		$this->senha=$s;
	}
		public function getSenha()
		{
			return $this->senha;	
		}
	public function setFoto($f)
	{
		$this->foto=$f;
	}
		public function getFoto()
		{
			return $this->foto;	
		}
	public function setNivel($ni)
	{
		$this->nivel=$ni;
	}
		public function getNivel()
		{
			return $this->nivel;	
		}


	public function Insert()
	{
		try {
		$sql="insert into ".$this->table." (nome,email,usuario,senha,thumb,nivel)
						values (:nome,:email,:usuario,:senha,:thumb,:nivel)";
		$stmt=	Conexao::prepare($sql);
		$stmt->bindParam(':nome',$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
		$stmt->bindParam(':usuario',$this->usuario,PDO::PARAM_STR);
		$stmt->bindParam(':senha',$this->senha,PDO::PARAM_STR);
		$stmt->bindParam(':thumb',$this->foto,PDO::PARAM_STR);
		$stmt->bindParam(':nivel',$this->nivel,PDO::PARAM_INT);
		$stmt->execute()or die(print_r($stmt->errorInfo(), true));
		$r=$stmt->rowCount();			
		if ($r>0) {
			return true;
		}else{
			return false;
		}
		
		} catch (PDOException $e) {
			echo $e;
		}
	}	
	public function Logar()
	{
		try {						// BINARY diferencia case sensitive
			$sql="select * from ".$this->table." where BINARY usuario=:usuario and BINARY senha=:senha";
			$stmt=	Conexao::prepare($sql);
			$stmt->bindParam(':usuario',$this->usuario);
			$stmt->bindParam(':senha',$this->senha);			
			$stmt->execute();
			$log=$stmt->fetchAll();						
			return $log;
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function SelImg($id)
	{
		try {
			$sql="select thumb from ".$this->table." where id = :id";
			$stmt=	Conexao::prepare($sql);	
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);							
			$stmt->execute();
			$imgDel=$stmt->fetch(PDO::FETCH_OBJ);										
			return $imgDel;
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function UpdateNoImage($nome, $email, $senha,$nivel, $id)
	{
		 $sql = "update ".$this->table." set nome= :nome,email= :email,senha= :senha, nivel= :nivel where id= :id";
                try {  
                  $stmt=Conexao::prepare($sql);                  
                  $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                  $stmt->bindParam(':senha', $senha, PDO::PARAM_STR); 
                  $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT);    
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
                  $stmt->execute();
                  return $stmt;
                  } catch (PDOException $e) {
					echo $e;
				  }
	}
	public function Update($nome, $email, $senha, $foto, $nivel, $id)
	{
	$sql = "update ".$this->table." set nome= :nome,email= :email,senha= :senha, thumb= :foto, nivel= :nivel where id= :id";
        try {  
          $stmt=Conexao::prepare($sql);                  
          $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':senha', $senha, PDO::PARAM_STR); 
          $stmt->bindParam(':foto', $foto, PDO::PARAM_STR); 
          $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT);    
          $stmt->bindParam(':id', $id, PDO::PARAM_INT);    
          $stmt->execute();
          return $stmt;
          } catch (PDOException $e) {
			echo $e;
		  }	
	}
}

 ?>