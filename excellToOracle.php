<?php
$row = 1;
if (($handle = fopen("MakeshopMemberAgree202211.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 150, ",")) !== FALSE) {
        if($row == 1) { // 1번 줄은 스킵
          $row++;
          continue;
        } 
        
        // 변수 정리
        $userId = trim(str_replace(array('"', '='), '', $data[1]));
        $agreeDate = trim($data[6]);

        if (empty($userId) || empty($agreeDate)) { // 무효값 스킵
          $row++;
          continue;
        }

        $updateSql = "UPDATE TCUSTOMER SET SMS_YN_DATE = TO_DATE('{$agreeDate}','YYYY-MM-DD HH24:mi:ss') WHERE MEM_ID = '{$userId}';";
        echo "<br>". $updateSql;
        
        $row++;

        if($row > 1000) break; // 1000 번 줄 까지만 노출
    }
    fclose($handle);
}
