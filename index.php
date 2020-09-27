<html>
  <head>
    <title>CSV stuff</title>
    <style>
      .tInp {
        width: 110px;
      }
      
      .wideTD {
         width: 120px;
      }
      
      .shortTD {
        width: 20px;
        text-align: center;
      }
    </style>
  </head>
  <body>
  
  
  <form action="./index.php" method="post">
    <table>
      <tr>
        <td class="wideTD">
          <p>Name</p>
          <input name="name" class="tInp">
        </td>
        <td class="wideTD">
          <p>Passwort</p>
          <input type="password" name="password" class="tInp">
        </td>
        <td class="wideTD">
          <p>Raum</p>
          <input name="room" class="tInp">
        </td>
        <td class="shortTD">
          <p>B1</p>
          <input name="b1" type="checkbox">
        </td>
        <td class="shortTD">
          <p>B2</p>
          <input name="b2" type="checkbox">
        </td>
        <td class="shortTD">
          <p>B3</p>
          <input name="b3" type="checkbox">
        </td>
        <td class="wideTD">
          <br>
          <input type="submit">
        </td>
      </tr>
    </table>
    <input type="hidden" name="method" value="newTeacher">
  </form>
    <?php
      //CSV file stuff
      require './csvLibrary.php';
      
      if(isset($_POST["method"])) {
        $m = $_POST["method"];
        if($m == "newTeacher") {
          fAddTeacher($_POST);
        } else if($m == "deleteRow") {
          fDeleteRow($_POST);
        }
      }
      
      function fAddTeacher($v) {
        if($v["name"] == "") return;
        if($v["password"] == "") return;
        if($v["room"] == "") return;
        
        $b1 = "0";
        $b2 = "0";
        $b3 = "0";
        
        if($v["b1"] != "") $b1 = "1";
        if($v["b2"] != "") $b2 = "1";
        if($v["b3"] != "") $b3 = "1";
        
        addTeacher($v["name"], $v["password"], $v["room"], $b1, $b2, $b3);
      }
      
      function fDeleteRow($v) {
        deleteRow($v["index"]);
      }
      
      
      echoFileAsTable();

    ?>
  </body>
</html>
