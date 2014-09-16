<?php 

    $postArray ='[{"data":{"hello":"world1"},"type":"1234","date":"2012-10-30 17:6:9","user":"000000000000000","time_stamp":1351587969902}, {"data":{"hello":"world2"},"type":"1234","date":"2012-10-30 17:12:53","user":"000000000000000","time_stamp":1351588373519}]';
     
    
    $de_json = json_decode($postArray,TRUE);
      $count_json = count($de_json);
        for ($i = 0; $i < $count_json; $i++)
           {
                //echo var_dump($de_json);
 
                  $dt_record = $de_json[$i]['date'];
                   $data_type = $de_json[$i]['type'];
                  $imei = $de_json[$i]['user'];
                  $message = json_encode($de_json[$i]['data']);
                   ECHO $message;
                }

?>



[{"mTime":"20140908","mSerialNo":"20140905015724","mEmail":"ahptcguxiang@163.com","cName":"sa","mLeadman":"小平","mDeliver":"送","mPayment":"FREX B2B","mPrice":"45824","mArriveTime":"20140912","pdfType":"1","cName":"SHO-BI株式会社","cPhone":"14532532432","mNameFlg":"1","historyFlg":"1","pName":"cxcx"},{"productList":{"name":"world1"}]