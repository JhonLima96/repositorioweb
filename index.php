<?php

include('connect.php');
// cria a instrução SQL que vai selecionar os dados
$query = mysql_query("SELECT * FROM produto");

// transforma os dados em um array
$linha = mysql_fetch_assoc($query);

// calcula quantos dados retornaram
$total = mysql_num_rows($query);

//definindo o tipo da função na varia epr
$epr = '';
$msg = '';
if(isset($_GET['epr']))
    $epr=$_GET['epr'];

if (isset($_POST['epr'])) $epr=$_POST['epr'];
if (isset($_GET['epr'])) $epr=$_GET['epr'];

//Salvar registro
if($epr=='save'){
    $descricao = $_POST['descricao'];
    $qtde = $_POST['qtde'];
    $preco = $_POST['preco'];
    $sql = mysql_query("INSERT INTO produto (descricao, qtde, preco) VALUES ('$descricao', '$qtde', '$preco')");
    if($sql)
       header("location:index.php");
    else
        $msg='Error :' .mysql_error();

}


//ativado ao clicar em DELETE
if($epr=='delete'){
    $id = $_GET['id'];
    $delete=mysql_query("DELETE FROM produto WHERE id= $id");
    if($delete)
        header('location:index.php');
    else
        $msg='Error :'.mysql_error();
}


?>

<html>
<head>
<title>Exemplo</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <h2 align="center"> Cadastrar um Produto </h2>

<form method="POST" action="index.php?epr=save">


    <table align=center>

    <div text-align="center">
    <tr><p>
        <td><label for="descricao"> Descrição: </label></td>
        <td><input type="text" name="descricao" id="descricao"></td>
    </p></tr>
    <tr><p>
        <td><label for="qtde">Quantidade: </label></td>
        <td><input type="text" name="qtde" id="qtde"></td>
    </p></tr>
    <tr ><p>
        <td><label for="preco"> Preço: </label></td>
        <td><input type="text" name="preco" id="preco"></td>
    </p></tr>

    </div>
    </table>
    <div align="center">
    <input type="submit" value="Adicionar" size="2000px">
    </div>
        </br></br>
    </form>
<table border="1" align="center">
    <tr>
        <td>ID</td>
        <td>Descrição </td>
        <td>Quantidade </td>
        <td>Preço </td>
        <td>Ação</td>
    </tr>
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
		// inicia o loop que vai mostrar todos os dados do banco de dados
		do {
?>

    <tr>
        <td><?=$linha['id']?></td>
        <td><?=$linha['descricao']?></td>
        <td><?=$linha['qtde']?></td>
        <td><?=$linha['preco']?></td>
        <td align="center">
            <a href="index.php?epr=delete&id='<?=$linha['id']?>'">DELETE</a>
        </td>
    </tr>


<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($query));
	// fim do if
	}
?>
 </table>
<?php echo $msg;?>

</body>
</html>
    <?php
// tira o resultado da busca da memória
mysql_free_result($query);
?>

