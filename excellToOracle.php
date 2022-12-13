
<?php
$row = 1;
$empty_sql = '';
$cnt = 0;

$empty_cnt = 0;
$start = empty($_GET['start']) ? 0 : trim($_GET['start']);
$end   = empty($_GET['end'])   ? 0 : trim($_GET['end']);
?>
<html>
<body></body>
<pre>
<?php
if (!empty($start) && !empty($end) && ($handle = fopen("MakeshopMemberAgree202211.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {

      if($row < $start) {
        $row++;
        continue;
      }

      if($row > $end) break; 

      if($row == 1) {
        $row++;
        continue;
      } 

      $userId    = trim(str_replace(array('"', '='), '', $data[1]));
      $email     = trim($data[3]);
      $smsDate   = trim($data[4]);
      $emailDate = trim($data[6]);
      $smsDate   = empty($smsDate) ? 'NULL' : "'{$smsDate}'";
      $emailDate = empty($emailDate) ? 'NULL' : "'{$emailDate}'";
      if (empty($userId)) {
        $row++;
        $empty_cnt++;
        $empty_sql .= "\n{$email} \t {$userId} \t {$smsDate} \t {$emailDate}";

      } else if(!empty($userId)) {
        $row++;
        $cnt++;
        $updateSql = "UPDATE TCUSTOMER SET SMS_YN_DATE = TO_DATE({$smsDate},'YYYY-MM-DD HH24:mi:ss'), EMAIL_YN_DATE = TO_DATE({$emailDate},'YYYY-MM-DD HH24:mi:ss') WHERE MEM_ID = '{$userId}';";
        echo "\n". $updateSql;

      }
      
    }

    fclose($handle);
}
?>
</pre>
<form name="frm" action="excellToOracle.php" method='get'> 
  <input type="text" name="start"  placeholder="start row number" value="<?=$start?>" />  ~   <input type="text" name="end"  placeholder="end row number" value="<?=$end?>" />
  <input type="submit" value="submit" onclick="this.form.submit();" />
  <!-- <button onclick="location.href=?start=end=;this.form.submit();" >submit</button> -->
</form>
<?php
echo "
<pre>
  normal $cnt rows / empty $empty_cnt rows
</pre>";

//echo "<br><br><br>  odd $odd_cnt rows <pre>". $odd_sql."</pre>";
echo "<br>  empty $empty_cnt rows <pre>". $empty_sql."</pre>";


// $tns = " 
// (DESCRIPTION =
//     (ADDRESS_LIST =
//       (ADDRESS = (PROTOCOL = TCP)(HOST = 124.53.101.117)(PORT = 1521))
//     )
//     (CONNECT_DATA =
//       (SERVICE_NAME = xe)
//     )
//   )
//        ";
// $db_username = "fine";
// $db_password = "fine2010";

// try{

//     $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
//     echo "��";

//     }catch(PDOException $e){
//     echo ($e->getMessage());
// }

// exit;
