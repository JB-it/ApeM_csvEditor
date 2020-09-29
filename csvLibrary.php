<?php
    //Content = [Name, password, Room, B1, B2, B3]
    //Name: String
    //Surname: String
    //Room: String
    //B1: Boolean
    //B2: Boolean
    //B3: Boolean

    $filePath = "data/";
    $fileName = "teachers.csv";
    $delimiter = ";";

    $file = $filePath.$fileName;

    function addTeacher($name, $password, $room, $b1, $b2, $b3) {
        //Password to SHA512-Hash   Password + Name(as salt)
        $password = hash("sha512", $password . $name);
        //Adds a teacher to the database
        global $file, $delimiter;
        $d = $delimiter;

        $txt = $name.$d.$password.$d.$room.$d.$b1.$d.$b2.$d.$b3."\n";

        file_put_contents($file, $txt, FILE_APPEND);
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


        //fclose($rFile);

    }
    function fileToJson()   //Info: json_encode(""); -> Array
    {
        global $file, $delimiter;
        $data = file_get_contents($file);
        $data = explode("\n", $data);

        $step = 0;
        $last = count($data);
        $last--;


        foreach($data as $key=>$item)//Cut by \n
        {
            foreach(explode($delimiter, $item) as $value)
            {
                    $teacherArray[$key][$step++] = $value;
            }
            $step = 0;
        }
        return json_encode($teacherArray);
    }

    function deleteRow($i) {
        global $file;

        $file_out = file($file); // Read the whole file into an array

        //Delete the recorded line
        unset($file_out[$i]);

        //Recorded in a file
        file_put_contents($file, implode("", $file_out));

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
    fileToJson();
?>
