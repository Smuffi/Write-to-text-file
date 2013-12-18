	<aside id="sidebar">
		<?php 

		if (file_exists('order.txt')) {

			$file = fopen("order.txt","r")or die("Can't open file.");

			while(!feof($file)){

				$type = fgets($file);
				$value = fgets($file);
				$number = fgets($file);
				$color = fgets($file);
				$size = fgets($file);
				$price = $number * $value;
				$totalPrice = $totalPrice + $price;

				echo $number . "x $color $type". "size: $size " . $price . "kr<br />";
			}

			echo "$totalPrice" . "kr";
			fclose($file);

			echo "<form action=\"index.php\" method=\"post\"><input type=\"submit\" name=\"checkout\" value=\"checkout\"><input type=\"submit\" name=\"reset\" value=\"Remove Order\"></form>";

		}else{
			echo "You have nothing in your order.";
		}

		?>
	</aside><!-- #sidebar -->
