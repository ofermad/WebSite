<?php
	$des=mysqli_connect("localhost","root","root");
	mysqli_select_db($des,"products");
	mysqli_set_charset($des,"utf8");
	
	if (isset($_GET['changed']) && $_GET['changed'] == "true")
	{
		$id = $_GET['id'];
		$tb_name=$_GET['tb_name'];
		$id_nm = $_GET['id_nm'];
		$pr_nm = $_GET['pr_nm'];
		
		$nm = $_GET['nm'];
		$quantity = $_GET['quantity'];
		$price = $_GET['price'];
		$img_path = $_GET['img_path'];
		//echo "UPDATE $tb_name SET $pr_nm='$nm', quantity=$quantity,price=$price,img_path='$img_path' WHERE $id_nm=$id";
		
		$sql = mysqli_query($des, "UPDATE $tb_name SET $pr_nm='$nm', quantity=$quantity,price=$price,img_path='$img_path' WHERE $id_nm=$id");
		echo '<a href="edit.php">Вернуться</a>';
	}
	else if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$tb_name=$_GET['tb_name'];
		
		if ($tb_name == "tires")
		{
			$id_nm="id_tires";
			$pr_nm='tires_name';
		}
		else if ($tb_name == "car_electronics")
		{
			$id_nm="id_electr";
			$pr_nm='electr_name';
		}
		else if ($tb_name == "other")
		{
			$id_nm="id_other";
			$pr_nm='other_name';
		}
		
		$sql = mysqli_query($des, "SELECT * FROM $tb_name WHERE $id_nm=$id");
		
		while($result = mysqli_fetch_array($sql))
		{
			$nm=$result[$pr_nm];
			$quantity=$result['quantity'];
			$price=$result['price'];
			$img_path=$result['img_path'];
		}
		echo '<a href="edit.php">Вернуться</a>';
	}
	else
	{
		echo "Что-то пошло не так";
		echo '<a href="edit.php">Вернуться</a>';
	}
?>

<form action="update.php" method=GET>
		<table id=form>
			<tr>
				<td><input type=hidden name=changed value="true"></td>
				<td><input type=hidden name=id value="<?php echo $id;?>"></td>
				<td><input type=hidden name=id_nm value="<?php echo $id_nm;?>"></td>
				<td><input type=hidden name=tb_name value="<?php echo $tb_name;?>"></td>
				<td><input type=hidden name=pr_nm value="<?php echo $pr_nm;?>"></td>
			</tr>
			<tr>
				<td>Название</td>
				<td><input type=text name=nm value="<?php echo htmlspecialchars($nm);?>"></td>
			</tr>
			<tr>
				<td>Количество</td>
				<td><input type=text name=quantity value="<?php echo $quantity;?>"></td>
			</tr>
			<tr>
				<td>Цена</td>
				<td><input type=text name=price value="<?php echo $price;?>"></td>
			</tr>
			<tr>
				<td>Путь к картинке</td>
				<td><input type=text name=img_path value="<?php echo $img_path;?>"></td>
			</tr>
			<tr>
				<td colspan=2><input type=submit value="Внести данные"></td>
					
			</tr>
		</table>
	</form>