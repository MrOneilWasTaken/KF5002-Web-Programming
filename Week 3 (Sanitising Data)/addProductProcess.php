<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<?php

	require_once("functions.php");
	$dbConn = getConnection();
	/* Get each parameter value from the request stream and using ternary if operators check each parameter to see if it was set. If it is, store it in a variable. Otherwise store a value of null in the variable */

	list($input, $errors) = validate_form();
	if ($errors) {

		echo show_errors($errors);

		if ($input['categoryID'] == 'c1') {
			$c1 = 'selected';
		} else {$c1 = '';}

		if ($input['categoryID'] == 'c2') {
			$c2 = 'selected';
		} else {$c2 = '';}

		if ($input['categoryID'] == 'c3') {
			$c3 = 'selected';
		} else {$c3 = '';}

		echo '<form method="get" action="addProductProcess.php">
						Product name <input type="text" name="productName" value="'.$input['productName'].'">
						Description <textarea name="description" value="'.$input['description'].'"></textarea>
						Category <select name="categoryID">
											<option value="c1">CD</option>
											<option value="c2">DVD</option>
											<option value="c3">Software</option>
										</select>
						Price <input type="text" name="price">
						<input type="submit" value="Add Product">
					</form>';

	}
	else {
		echo process_form($input);
	}


	?>


	</body>
</html>
