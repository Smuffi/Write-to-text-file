<?php include 'header.php'; ?>

	<?php 

	if (isset($_POST['jacket'])) {
		$jacketType = $_POST['jacket-type'];
	}elseif (isset($_POST['submit'])) {
		if ($_POST['number'] > 0) {
			echo "<p>Order accepted!</p>";

			$jacketType = $_POST['type'];
			$Type = $jacketType . "-jacket";
			$Value = $_POST['value'];
			$nr = $_POST['number'];
			$Color = "";
			$Size = $_POST['size'];

			if (file_exists("order.txt")) {
				$file = fopen("order.txt","a")or die("Can't open file.");
				fwrite($file, "\n$Type\n$Value\n$nr\n$Color\n$Size");
			}else{
				$file = fopen("order.txt","a")or die("Can't open file.");
				fwrite($file, "$Type\n$Value\n$nr\n$Color\n$Size");
			}
			fclose($file);
		}else{
			echo "You need to order at least 1.";
		}

	}else{
		echo "Something went horribly wrong. Try again.";
		return;
	}

	if ($jacketType == "Rainbow Dash") {
		echo "<img src=\"pony-jacket.jpg\" height=\"150px\" width=\"150px\" />";
	}elseif ($jacketType == "Wonderbolts") {
		echo "<img src=\"wonderbolts-jacket.png\" height=\"150px\" width=\"300px\" />";
	}elseif ($jacketType == "Lord of the Ring") {
		echo "<img src=\"lotr-jacket.jpeg\" height=\"150px\" width=\"150px\" />";
	}elseif ($jacketType == "Nascar") {
		echo "<img src=\"nascar-jacket.jpg\" height=\"150px\" width=\"150px\" />";
	}else{
		echo "Something went wrong. Try again.";
	}

	?>

	<form action="jacket.php" method="post">
		<input class="hidden" value="<?php echo $jacketType; ?>" name="type" readonly><br />
		<input class="hidden price" value="150kr" name="value" readonly /><br />
		<input type="number" value="0" name="number" /><br />
		<input type="radio" name="size" value="small">Small</input><br />
		<input type="radio" name="size" value="medium" checked>Medium</input><br />
		<input type="radio" name="size" value="large">Large</input><br />
		<input type="submit" name="submit" value="Order!" />
	</form>

</section><!-- #content -->

<?php include 'sidebar.php'; ?>

</div><!-- #wrapper -->
</body>
</html>
