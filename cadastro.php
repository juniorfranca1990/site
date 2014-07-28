<?php 
	try{
		$conn = new PDO('mysql:host=localhost;dbname=site2', 'root', '');
	}catch(PDOException $e){
		echo $e->getMessage();
	}

	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$inserir = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (:email,:senha)");
	$inserir->bindParam(':email', $_POST['email']);
	$inserir->bindParam(':senha', $_POST['senha']);

	$validar = $conn->prepare("SELECT * FROM usuarios WHERE email=?");
	$validar->execute(array($email));
	if($validar->rowCount() == 0):
		$inserir->execute();
		echo "Cadastrado";
	else:
		echo "Ja existe! <br/> Volte e tente novamente!";
	endif;
?>