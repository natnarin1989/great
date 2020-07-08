<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <div id="returnDiv"> <a href="index.php" id="return">กลับหน้าหลัก</a></div>
        <?php
         header("Location:index.php");
        include_once("db_pdo.php");
        
        
        $sql = "UPDATE customerdata SET customerName = :customerName, 
            companyName = :companyName,  
            phoneNumber = :phoneNumber,  
            LINEID= :LINEID, 
            email = :email, 
            address = :address
            WHERE id=:id";

  // Prepare statement
  $stmt = $dbh->prepare($sql);   
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
$stmt->bindParam(':customerName', $customerName, PDO::PARAM_STR);       
$stmt->bindParam(':companyName', $companyName, PDO::PARAM_STR);    
$stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
$stmt->bindParam(':LINEID', $LINEID, PDO::PARAM_STR); 
$stmt->bindParam(':email', $email, PDO::PARAM_STR);   
$stmt->bindParam(':address', $address, PDO::PARAM_STR);   
 try{
$stmt->execute();
        echo "ปรับปรุงข้อมูลเรียบร้อยแล้ว";
                                } catch(PDOException $e) {
                                         echo   "ไม่สามารถแก้ไขข้อมูลได้".$e->getMessage();
                                 }


    
        
        
 /*
if(isset($_POST['id']))
{    
                                 echo "<script type='text/javascript'>"; 
                                 echo "alert('Error Contact Admin !!');"; 
                                 echo "window.location = 'insert_pdo.php'; "; 
                                 echo "</script>";
}

    $id = $_POST['id'];
    $customerName = $_POST['customerName'];  
    $companyName =$_POST['companyName'];
    $phoneNumber =$_POST['phoneNumber'];
    $LINEID =$_POST['LINEID'];
    $email= $_POST['email'];    
    $address =$_POST['address'];
    
    // checking empty fields
    if(empty($customerName) || empty($companyName) || empty($phoneNumber) || empty($LINEID) || empty($email) || empty($address)) {    
            
        if(empty($customerName)) {
            echo "<font color='red'>customerName  field is empty.</font><br/>";
        }
        
        if(empty($companyName)) {
            echo "<font color='red'>companyName  field is empty.</font><br/>";
        }
        
        if(empty($phoneNumber)) {
            echo "<font color='red'>phoneNumber  field is empty.</font><br/>";
        }
        
        if(empty($LINEID)) {
            echo "<font color='red'>LINEID  field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }        
        
         if(empty($address)) {
            echo "<font color='red'>address  field is empty.</font><br/>";
        } 
        
    } else {    
        //updating the table
        
       $sql = "UPDATE customerdata SET  
            customerName = :customerName, 
            companyName = :companyName,  
            phoneNumber = :phoneNumber,  
            LINEID= :LINEID, 
            email = :email, 
            address = :address
            WHERE  id = :id";
        $stmt = $dbh->prepare($sql);   
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
$stmt->bindParam(':customerName', $customerName, PDO::PARAM_STR);       
$stmt->bindParam(':companyName', $companyName, PDO::PARAM_STR);    
$stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
$stmt->bindParam(':LINEID', $LINEID, PDO::PARAM_STR); 
$stmt->bindParam(':email', $email, PDO::PARAM_STR);   
$stmt->bindParam(':address', $address, PDO::PARAM_STR);   
 try{
$stmt->execute();
        echo "ปรับปรุงข้อมูลเรียบร้อยแล้ว";
                                } catch(PDOException $e) {
                                         echo   "ไม่สามารถแก้ไขข้อมูลได้".$e->getMessage();
                                 }
        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
                
        //redirectig to the display page. In our case, it is index.php
       // header("Location: search.php");
    }*/

        
?>
        
    </body>
</html>
