<?php include 'header.php'; ?>
	
	<?php

		if (isset($_POST['headwear'])) {
			$headwearType = $_POST['headwear-type'];
		}elseif (isset($_POST['submit'])) {
			if ($_POST['number'] > 0) {
				echo "<p>Order accepted!</p>";

				$headwearType = $_POST['type'];
				$Type = $headwearType;
				$Value = $_POST['value'];
				$nr = $_POST['number'];
				$Color = $_POST['color'];
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

		if ($headwearType == "Tophat") {
			echo "<img src=\"tophat.jpg\" height=\"150px\" width=\"150px\" />";
		}elseif ($headwearType == "Cap") {
			echo "<img src=\"cap.jpg\" height=\"150px\" width=\"170px\" />";
		}else{
			echo "Something went wrong with the image. Try again.";
		}
		
	?>

	<form action="headwear.php" method="post">
		<input class="hidden" value="<?php echo $headwearType; ?>" name="type" readonly><br />
		<input class="hidden price" value="90kr" name="value" readonly /><br />
		<input type="number" value="0" name="number" /><br />
		<?php

			if ($headwearType == "tophat") {
				echo "
				<select name=\"color\">
					<option name=\"color\" value=\"yellow\">Yellow</option>
					<option name=\"color\" value=\"black\">Black</option>
					<option name=\"color\" value=\"red\">Red</option>
					<option name=\"color\" value=\"green\">Green</option>
					<option name=\"color\" value=\"blue\">Blue</option>
					<option name=\"color\" value=\"white\">White</option>
				</select><br />
				";	
			}elseif ($headwearType == "cap") {
				echo "
				<select name=\"color\">
					<option name=\"color\" value=\"yellow\">Yellow</option>
					<option name=\"color\" value=\"black\">Black</option>
					<option name=\"color\" value=\"red\">Red</option>
					<option name=\"color\" value=\"green\">Green</option>
					<option name=\"color\" value=\"blue\">Blue</option>
					<option name=\"color\" value=\"white\">White</option>
					<option name=\"color\" value=\"pink\">Pink</option>
					<option name=\"color\" value=\"cyan\">Cyan</option>
					<option name=\"color\" value=\"purple\">Purple</option>
					<option name=\"color\" value=\"orange\">Orange</option>
					<option name=\"color\" value=\"tan\">Tan</option>
				</select><br />
				";
			}
		?>
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
