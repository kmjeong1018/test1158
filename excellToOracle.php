<?php
$row = 1;
$empty_sql = '';
$char_sql = '';
$cnt = 0;

$empty_cnt = 0;
$char_cnt = 0;
$start = empty($_GET['start']) ? 0 : trim($_GET['start']);
$end   = empty($_GET['end'])   ? 0 : trim($_GET['end']);
?>
<html>
<body></body>
<pre>
<?php

function date_check($str) { // 날자 포멧 체크
  // 2022/11/01 (13:34)
  
  //if ($str == 'NULL') return true;
  if ($str == '') return false;
  else {
    $str = str_replace("'", "", $str);
    preg_match('/^(\d{4})\/(\d{2})\/(\d{2}) \((\d{2}):(\d{2})\)$/', $str, $match);
    return (count($match) == 6);
  }
}

if (!empty($start) && !empty($end) && ($handle = fopen("MakeshopMemberAgree202211.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {

      // 변수정리
      $userId    = trim(str_replace(array('"', '='), '', $data[1]));
      $email     = trim($data[3]);
      $smsDate   = trim($data[4]);
      $emailDate = trim($data[6]);
      
      $smsDate   = empty($smsDate) ? '' : "'{$smsDate}'";
      $emailDate = empty($emailDate) ? '' : "'{$emailDate}'";

      // $smsDate   = empty($smsDate) ? 'NULL' : "'{$smsDate}'";
      // $emailDate = empty($emailDate) ? 'NULL' : "'{$emailDate}'";

      $smsDateStr = empty($smsDate) ? '' : " SMS_YN_DATE = TO_DATE({$smsDate},'YYYY-MM-DD HH24:mi:ss')";
      $emailDateStr = empty($emailDate) ? '' : " EMAIL_YN_DATE = TO_DATE({$emailDate},'YYYY-MM-DD HH24:mi:ss')";
      
      if($row < $start) {
        $row++;

      } else if($row > $end) {
        break; 

      } else if($row == 1) { // 엑셀 헤더 무시
        $row++;

      } else if(date_check($emailDate) == false && date_check($smsDate) == false) { // 하나라도 null 이면 스킵
        $row++;
        $char_cnt++;
        $char_sql .= "\n{$email} \t {$userId} \t {$smsDate} \t {$emailDate}";
        
      } else if (empty($userId)) { // 아이디가 없다면 스킵
        $row++;
        $empty_cnt++;
        $empty_sql .= "\n{$email} \t {$userId} \t {$smsDate} \t {$emailDate}";

      } else if(!empty($userId)) { 
        $row++;
        $cnt++;
        $upSql = $smsDateStr;

        if ($upSql) {
          $upSql .= ", " . $emailDateStr;
        } else {
          $upSql .= $emailDateStr;
        }

        if ($upSql) $updateSql = "UPDATE TCUSTOMER_20221213 SET $upSql WHERE MEM_ID = '{$userId}';";
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
  normal $cnt rows / empty $empty_cnt rows / charactor $char_cnt rows
</pre>";


//echo "<br>  empty $empty_cnt rows <pre>". $empty_sql."</pre>";
//echo "<br>  charactor $char_cnt rows <pre>". $char_sql."</pre>";


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
