	<aside id="sidebar">
		<?php 

		if (file_exists('order.txt')) {

			$file = fopen("order.txt","r")or die("Can't open file.");

			while(!feof($file)){

				// Write get the lines from order.txt and put them into separated variables to be used later.
				$type = fgets($file);
				$value = fgets($file);
				$number = fgets($file);
				$color = fgets($file);
				$size = fgets($file);
				$price = $number * $value;
				$totalPrice = $totalPrice + $price;

				// use the variables to print out a decent looking cart.
				echo $number . "x $color $type". "size: $size " . $price . "kr<br />";
			}

			// Print the total price of all our wares in the cart.
			echo "$totalPrice" . "kr";
			fclose($file);

			echo "<form action=\"index.php\" method=\"post\"><input type=\"submit\" name=\"checkout\" value=\"checkout\"><input type=\"submit\" name=\"reset\" value=\"Remove Order\"></form>";

		}else{
			// Incase the cart is empty / non-existant.
			echo "You have nothing in your order.";
		}

		?>
	</aside><!-- #sidebar -->
