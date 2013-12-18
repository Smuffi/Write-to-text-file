<?php include 'header.php'; ?>

	<?php 

		// If we want to write out the register.
		if (isset($_POST['submit'])) {
			$reg = fopen("register.txt","r")or die("Can't open file.");

			while (!feof($reg)) {
				echo fgets($reg) . "<br />";
			}
			fclose($reg);

		// Or if we want to checkout.
		}elseif (isset($_POST{'checkout'})) {
			$order = fopen("order.txt", "r")or die("Can't open file.");

			// Write out the full order of all the items in the cart.
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

			// After the order is printed on the screen the user needs to put in a mail and name. (login).
			echo "<form action=\"index.php\" method=\"post\"><br />";
			echo "Name:<input name=\"name\"><br />";
			echo "Mail:<input name=\"mail\"><br />";
			echo "Adress:<input name=\"adress\"><br />";
			echo "<input type=\"submit\" name=\"confirm\" value=\"Confirm\">";
			echo "</form>";


		}elseif (isset($_POST['confirm'])) {
			// Confirming your name / email (login) write the order + name / email into the registery.
			$reg1 = fopen("register.txt", "a")or die("Can't open file.");
			$order1 = fopen("order.txt", "r")or die("Can't open file.");

			$Adress = $_POST['adress'];
			$Name = $_POST['name'];
			$Mail = $_POST['mail'];

			fwrite($reg1, "\nName: $Name\nAdress: $Adress\nMail: $Mail\n\n$Name Ordered:\n");

			while (!feof($order1)) {
				// Get the order and put it into the registery.
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

			// Print the order out on the screen one last time with the name and email.
			fwrite($reg1, "\nFor a total of $totalPrice" . "kr\n");
			fwrite($reg1, "------------------------------------------");

			fclose($reg1);
			fclose($order1);
			// Delete the order.txt. Effectively resetting cart.
			unlink("order.txt");
		}elseif (isset($_POST['reset'])) {
			// Simple reset of the card / order.
			unlink("order.txt");
			echo "Order reset.";
		}

	?>

	<form action="index.php" method="post">
		<input type="submit" name="submit" value="Show Register" />
	</form>

</section><!-- #content -->

<!-- Includes the sidebar where the cart and similar stuff are located -->
<?php include 'sidebar.php'; ?>

</div><!-- #wrapper -->
</body>
</html>
