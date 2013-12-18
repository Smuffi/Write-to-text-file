<?php include 'header.php'; ?>

	<?php 

		if (isset($_POST['submit'])) {
			$reg = fopen("register.txt","r")or die("Can't open file.");

			while (!feof($reg)) {
				echo fgets($reg) . "<br />";
			}
			fclose($reg);

		}elseif (isset($_POST{'checkout'})) {
			$order = fopen("order.txt", "r")or die("Can't open file.");

			while (!feof($order)) {
				$type = fgets($order);
				$value = fgets($order);
				$number = fgets($order);
				$color = fgets($order);
				$size = fgets($order);
				$price = $number * $value;
				$totalPrice1 = $totalPrice1 + $price;

				echo $number . "x $color $size $type". ":  " . $price . "kr<br />";
			}
			fclose($order);
			echo "For a total price of $totalPrice1<br />";

			echo "<form action=\"index.php\" method=\"post\"><br />";
			echo "Name:<input name=\"name\"><br />";
			echo "Mail:<input name=\"mail\"><br />";
			echo "Adress:<input name=\"adress\"><br />";
			echo "<input type=\"submit\" name=\"confirm\" value=\"Confirm\">";
			echo "</form>";


		}elseif (isset($_POST['confirm'])) {
			$reg1 = fopen("register.txt", "a")or die("Can't open file.");
			$order1 = fopen("order.txt", "r")or die("Can't open file.");

			$Adress = $_POST['adress'];
			$Name = $_POST['name'];
			$Mail = $_POST['mail'];

			fwrite($reg1, "\nName: $Name\nAdress: $Adress\nMail: $Mail\n\n$Name Ordered:\n");

			while (!feof($order1)) {
				$type = fgets($order1);
				$value = fgets($order1);
				$number = fgets($order1);
				$color = fgets($order1);
				$size = fgets($order1);
				$price = $number * $value;
				$totalPrice = $totalPrice + $price;

				$string = trim(preg_replace('/\s+/', ' ', $number . "$color $size $type". ":  " . $price . "kr"));

				fwrite($reg1, $string . "\n");
			}

			fwrite($reg1, "\nFor a total of $totalPrice" . "kr\n");
			fwrite($reg1, "------------------------------------------");

			fclose($reg1);
			fclose($order1);
			unlink("order.txt");
		}elseif (isset($_POST['reset'])) {
			unlink("order.txt");
			echo "Order reset.";
		}

	?>

	<form action="index.php" method="post">
		<input type="submit" name="submit" value="Show Register" />
	</form>

</section><!-- #content -->

<?php include 'sidebar.php'; ?>

</div><!-- #wrapper -->
</body>
</html>
