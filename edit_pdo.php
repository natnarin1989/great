<?php
 $id = null;
              if(isset($_POST["id"]))
                 {
                      $id = $_POST["id"];
                    }
?>
<html>
<head>    
    <title>Edit Data</title>
    <link rel="stylesheet" href="edit_pdo.css" type="text/css" />
</head>
 
<body>
    <div id="returnDiv"> <a href="index.php" id="return">กลับหน้าหลัก</a></div>
    <br/>
    <?php
  

                      
    require_once('db_pdo.php'); 

$sql = "Select  *  from  customerdata WHERE id=:id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':id' => $id));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

 
          
    ?>
    <form name="form1" method="POST" action="edit_Save_pdo.php">
        <table id="tableFormAdd">
            <tr> 
                <th  class="topic">รหัสลูกค้า</th>
                <td class="input"><input type="text" name="id"  value="<?php echo $row["id"];?>" /> </td>  
            </tr>
            <tr> 
                <th class="topic">ชื่อลูกค้า</th>
                <td class="input"><input type="text" name="customerName" value="<?php echo $row['$customerName'];?>"/></td>
            </tr>
            <tr> 
                 <th class="topic">ชื่อบริษัท</th>
                <td class="input"><input type="text" name="companyName" value="<?php echo  $row['$companyName'];?>"/></td>
            </tr>
            <tr> 
                 <th class="topic">เบอร์โทร</th>
                <td class="input"><input type="text" name="phoneNumber" value="<?php echo  $row['$phoneNumber'];?>"/></td>
            </tr>
            <tr> 
               <th class="topic">ไลน์ไอดี</th>
                <td class="input"><input type="text" name="LINEID" value="<?php echo  $row['$LINEID'];?>"/></td>
            </tr>
            <tr> 
                <th class="topic">อีเมล</th>
                <td class="input"><input type="text" name="email" value="<?php echo   $row['$email'];?>"/></td>
            </tr>
            <tr> 
                <th class="topic">ที่อยู่</th>
                <td class="textAreaAddress"><input type="text" id="address" name="address" value="<?php echo   $row['$address'];?>" /></td>
            </tr>
            <tr>
                <!--<td><input type="hidden" name="id" value=<?php /*echo $_GET['id'];*/?>/></td>  -->
                <td><input type="submit" name="update" value="อัปเดตแก้ไขข้อมูล" id="editSubmit"></td>
            </tr>
        </table>
    </form> 
        
    </body>
</html>
