<?php
	//Content = [Name, password, Room, B1, B2, B3]
	//Name: String
	//Surname: String
	//Room: String
	//B1: Boolean
	//B2: Boolean
	//B3: Boolean

	$filePath = "./";
	$fileName = "teachers.csv";
	$delimiter = ";";
	
	$file = $filePath.$fileName;

	function addTeacher($name, $password, $room, $b1, $b2, $b3) {
		//Adds a teacher to the database
		global $file, $delimiter;
		$d = $delimiter;
		
		$wFile = fopen($file, "a");
		$txt = $name.$d.$password.$d.$room.$d.$b1.$d.$b2.$d.$b3."\n";
		fwrite($wFile, $txt);
		fclose($wFile);
	}
	
	function echoFileAsTable() {
		global $file, $delimiter;
		$rFile = file($file);
		$d = $delimiter;
		
		echo "<table>";
		
		$s = 0;
		foreach($rFile as $line) {
			echo "<tr>";
			
			$vars = explode($d, $line);
			
			for($i=0; $i < sizeof($vars); $i++) {
				
				if($i < 3) echo "<td class='wideTD' >";
				else echo "<td class='shortTD' >";
				
				echo $vars[$i]."</td>";
			}		
			echo "<td class='wideTD' >";
			echo '<form action="./index.php" method="post">';
			echo '<input type="hidden" name="index" value="'.$s.'">';
			echo '<input type="hidden" name="method" value="deleteRow">';
			echo '<input type="submit" value="delete">';
			echo '</form>';
			echo "</td>";
				
			echo "</tr>";
			$s++;
		}
		
		echo "</table>";
		
		
		fclose($rFile);
		
	}
	
	function deleteRow($i) {
		global $file;
		
		$file_out = file($file); // Read the whole file into an array

		//Delete the recorded line
		unset($file_out[$i]);

		//Recorded in a file
		file_put_contents($file, implode("", $file_out));
		fclose($rFile);
		
	}
	
	function dumpFile() {
		global $file;
		
		echo "<br>File dump begin<br>";
		
		$rFile = file($file);
		foreach($rFile as $line) {
			echo $line."</br>";
		}
		fclose($rFile);
		echo "File dump ended<br>";
	}
?>
