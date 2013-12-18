<?php include 'header.php'; ?>

	<img src="socks.jpg" height="150px" width="150px" />

	<?php 

		if (isset($_POST['submit'])) {
			if ($_POST['number'] > 0) {
				echo "<p>Order accepted!</p>";

				// Get the values from the form and put them into variables.
				$Type = "Socks";
				$Value = $_POST['value'];
				$nr = $_POST['number'];
				$Color = $_POST['color'];
				$Size = $_POST['size'];

				// Take the variables and put them into order.txt.
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

		}

	?>

	<form action="socks.php" method="post">
		<input class="hidden" value="Socks" name="type" readonly /><br />
		<input class="hidden price" value="40kr" name="value" readonly /><br />
		<input type="number" value="0" name="number" /><br />
		<select name="color">
			<option value="yellow">Yellow</option>
			<option value="orange">Orange</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select><br />
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
