<html>
<body>
	<form method='post'> 
		<select name='movie' id='movieselector'>
			<option value=movie1> Movie 1 </option>
			<option value=movie2> Movie 2 </option>
			<option value=movie3> Movie 3 </option>
		</select>
		<input type='submit' value='Update!'>
	</form>
	<form method="post">
		<?php
		$servername = /*insert SQL server address*/;
		$accessusername = /*"webadmin"*/;
		$accesspassword = /*"Asdf12345$!q"*/;
		$table = /*insert SQL table name here*/;
		$db = /*insert SQL db name here*/;

		// Create connection
		$conn = new mysqli($servername, $accessusername, $accesspassword, $db);
		// Check connection
		if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

		//collect results from movieselector dropdown
		$movie = $_POST["movie"];

		//builds dropdown of available seats for a given movie
		echo "<select name='seatselector'>";
			$seatrequest = "SELECT seatID, bookState FROM ".$table." WHERE bookState='free' AND movie='".$movie."'";

			if($result = mysqli_query($conn, $seatrequest)){
				if(mysqli_num_rows($result) > 0){
					//create dropdown entry for each SQL table row
				    while($row = mysqli_fetch_array($result)){
				    	echo "<option value='".$row["seatID"]."'>"." Seat ".$row["seatID"]."</option>";}
				    // Free result set
				    mysqli_free_result($result);
				} else{
				    echo "No records matching your query";}
			} else{
			echo "ERROR: Could not execute " . mysqli_error($conn);}
			// Close connection
		echo "</select>";
		echo "<input type='submit' value='Book Seats'>";

		//close connection
		mysqli_close($conn);
		?>
	</form>

</body>
</html>
