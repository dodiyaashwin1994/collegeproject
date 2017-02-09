<?php
include ('includes/configure.php');
?>

<form name="import" method="post" enctype="multipart/form-data">
     <input type="file" name="file" /><br />
        <input type="submit" name="submit" value="Submit" />
</form>
<?php
if(isset($_POST["submit"]))
{
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	$c = 0;
	while(($filesop = fgetcsv($handle, 10000, ",")) !== false)
	{
		$stncode = $filesop[0];
		$stnname = $filesop[1];

		$sql ="INSERT INTO station (stncode, stnname) VALUES ('$stncode','$stnname')";
    $conn->query($sql);
	}

		if($conn->query($sql)){
			echo "You database has imported successfully";
		}else{
			echo "Sorry! There is some problem.";
		}
}
?>
