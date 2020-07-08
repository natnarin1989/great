<?php
define("ROW_PER_PAGE",5);
require_once('db_pdo.php');  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="index.css" type="text/css" />
    </head>
    <body>                                     
         <?php
        $per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * ROW_PER_PAGE;
	}
	$limit=" limit " . $start . "," . ROW_PER_PAGE;
          $sql = "SELECT SQL_CALC_FOUND_ROWS *  from  customerdata";
        
        $pagination_statement = $dbh->prepare($sql);
	
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/ROW_PER_PAGE);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					 $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />'.'&nbsp;&nbsp;';
				} else {
					 $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />'.'&nbsp;&nbsp;';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $dbh->prepare($query);	
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll(); 
?>
                <?php
        $search_keyword = '';
        if(isset($_POST['Search'])){
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	$sql = "SELECT *  from  customerdata WHERE id LIKE  :keyword   or  customerName LIKE  '$search_keyword%'  "
                                                                                  . "or  companyName LIKE  '$search_keyword%' "
                                                                                  . "or  phoneNumber  LIKE  '$search_keyword%' "
                                                                                  . "or  LINEID  LIKE  '$search_keyword%' "
                                                                                  . "or  email  LIKE  '$search_keyword' ";
                                                                                                                         
                                      
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll();
        }
        ?>
             
        
        <h2 id="topic">ข้อมูลลูกค้า</h2>
   
            
          <form id="form_checkbox1" name='frmSearch' action='' method='POST'>
              <div id="total">
              <div id="searchKeyWord">
                <label id="search">ค้นหาข้อมูล</label>&nbsp;&nbsp;
                  <input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25' placeholder='ชื่อลูกค้า'>&nbsp;&nbsp;
                  <input type="submit" name='Search' value="Search"   id="submit">            
             </div>
          </form>  <br><br>
     <a href="add_pdo.html" id="add">เพิ่มข้อมูลใหม่</a>  <br><br>
                
        
        <form id="form_checkbox1" name='frmSearch' action='frmSearch.php' method='POST'>
            
            
<!--            <h3 id='textTotalCheck'> <INPUT type="checkbox"  id="totalCheck"  onchange="checkAll_d1(this.form.check)"  name="chk_all_day1" /> เลือกทั้งหมด  &nbsp;&nbsp;-->
            <h3 id='textTotalCheck'> <INPUT type="checkbox"  id="totalCheck"  name="chk_all_day1" /> เลือกทั้งหมด  &nbsp;&nbsp;
                <input  id="btnPrint"  name="btnSubmit" type="submit" value="ปริ้น"></h3>  
        </div>  
          <!--  <div style='text-align:right;margin:20px 0px;'>
                <label for="Se">เลือกคอลัมน์ ที่จะค้นหา</label>
  <select name="'search[keyword]'" id="cars">
      <option value="id">กรุณา เลือกหัวข้อ</option>
    <option value="id">รหัสลูกค้า</option>
    <option value="customerName">ชื่อลูกค้า</option>
    <option value="companyName">ชื่อบริษัท</option>
    <option value="phoneNumber">เบอร์โทร</option>
    <option value="LINEID">ไลน์ไอดี</option>
  </select>
           
            </div> -->         
                      
            <table id='table1'>
  <thead>
	<tr>
                              
                                <th>รหัสลูกค้า</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ชื่อบริษัท</th>
                                <th>เบอร์โทร</th>
                                <th>ไลน์ไอดี</th>
                                <th>อีเมล</th>
                                <th>ที่อยู่</th>
                                <th id="update">อัปเดต</th>
	  
	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
       $css_all_check=0;  
	if(!empty($result)) { 
		foreach($result as $row) {
                       $css_all_check= $css_all_check+1;
	?>
	  <tr>           
                                    
          
              <td id="checkID"><div  id="checkDiv"><input  type="checkbox"  id="checkIn" class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["id"];?>"></div>
                                   <?php  echo $row["id"];?></td>     
                               
                  <td><input  type="checkbox"  id="checkIn1" class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["customerName"];?>">    
                      <br><?php  echo $row["customerName"];?></td>
                  
                                 <td><input  type="checkbox"   id="checkIn2"  class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["companyName"];?>">  
                                     <br><?php  echo $row["companyName"];?></td>
                                 
                                 <td><input  type="checkbox"   id="checkIn3"  class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["phoneNumber"];?>">
                                     <br><?php  echo $row["phoneNumber"];?></td>
                                 
                                 <td><input  type="checkbox"    id="checkIn4"  class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["LINEID"];?>">
                                     <br><?php  echo $row["LINEID"];?></td>
                                 
                                 <td><input  type="checkbox"  id="checkIn5"  class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["email"];?>">
                                     <br><?php  echo $row["email"];?></td>
                                 
                                 <td><input  type="checkbox"  id="checkIn6"  class="css_all_check<?php echo $css_all_check;?> " name="chkData[]" value="<?php  echo $row["address"];?>">
                                     <br><?php  echo $row["address"];?></td>
                                 
                                 <td>
                                     <a  id="edit" href="edit_pdo.php?id=<?php  echo $row['id'];?>">แก้ไข</a>       &nbsp;&nbsp;&nbsp; |
                                    
                                     <a id="delete" href="delete_pdo.php?id=<?=$row['id'];?>" onClick="return confirm('คุณต้องการจะลบข้อมูลหรือไม่?')">ลบ</a>      
    
                                 </td>
	  </tr>
          
    <?php
		}
	}
	?>
  
  </tbody>
</table>
</form>   
   
          <form id="form_checkbox1" name='frmSearch' action='' method='POST'>
              
        <?php echo $per_page_html; ?>          
</form>   
        
        
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
<script type="text/javascript">  
/*$(function(){        
      $("[name='chkData[]']").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม
          console.log($(this).attr('id'));
         if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก
             $("."+$(this).attr('id')).prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด \
            $("[name='chkData[]']").prop("checked",true);
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก                  $("."+$(this).attr('id')).prop("checked",false);
             $("[name='chkData[]']").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                       }
      }});      */
     
       $("#totalCheck").click(function(){ 
             console.log($(this).prop("checked"));
            if($(this).prop("checked")){ 
                $("[name='chkData[]']").prop("checked",true);
            }
            else{
                $("[name='chkData[]']").prop("checked",false);
            }
      }); 
         $("[name='chkData[]']").click(function(){
    console.log($(this).attr('class'));
    var name= $(this).attr('class');  //  ตัวแปรชื่อเนม name  ตั้งชื่อขึ้นมาเอง
    if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $('.'+name).prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด         //นำตัวแปรชื่อ name มาใส่     
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
           $('.'+name).prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด          //นำตัวแปรชื่อ name มาใส่                                               
        }   
    
});
</script> 
<script>
//$(function(){        
////    $("#checkIn").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
////        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
////            $(".css_all_check1").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
////        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
////            $(".css_all_check1").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
////        }   
////      });      
//
//
//});   
//</script>
<!--<script>
$(function(){        
    $("#checkIn.css_all_check2").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check2").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
            $(".css_all_check2").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>

<script>
$(function(){        
    $("#checkIn.css_all_check3").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check3").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
            $(".css_all_check3").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>

<script>
$(function(){        
    $("#checkIn.css_all_check4").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check4").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
            $(".css_all_check4").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>

<script>
$(function(){        
    $("#checkIn.css_all_check5").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check5").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
            $(".css_all_check5").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>
(((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((
$(function(){        (((((((((((((((((((((((((((((((((((((((((((((((((((((((((
    $("#checkIn.css_all_check6").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check6").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  ((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((
            $(".css_all_check6").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>

<script>
$(function(){        
    $("#checkIn.css_all_check7").click(function(){ // เมื่อคลิกที่ checkbox ตัวควบคุม  
        if($(this).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก  
            $(".css_all_check7").prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด              
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก  
            $(".css_all_check7").prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี class ตามกำหนด                                                   
        }   
      });      
});  
</script>-->
    </body>
</html>
