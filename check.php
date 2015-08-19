<?php
ignore_user_abort(); //关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(0); // 通过set_time_limit(0)可以让程序无限制的执行下去
$interval=60*5; // 每隔5分钟运行
do{
	$do = "http://panda.www.net.cn/cgi-bin/check.cgi?area_domain=xxx.com";
	$xml_data = file_get_contents($do);
	$xml_arr = (array)simplexml_load_string($xml_data);
	$status=  substr($xml_arr['original'],0,3);   
	//$status=  210; 
	//210：可以注册
	//211：已经注册
	//212：参数错误
	//214：未知错误
	    if($status=="210"){
		    $filei ='i.txt';
		    echo $i = file_get_contents($filei);
		    $url = "http://smsapi.c123.cn/OpenPlatform/OpenApi?action=sendOnce&ac=xxx&authkey=xxx&cgid=xxx&c=起床了，起床了，起来注册域名了&m=xxx";
			    if ($i<10) {
			    	if ($i<2) {
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, "http://voice-api.luosimao.com/v1/verify.json");

						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
						curl_setopt($ch, CURLOPT_HEADER, FALSE);

						curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
						curl_setopt($ch, CURLOPT_USERPWD  , 'api:key-xxx');

						curl_setopt($ch, CURLOPT_POST, TRUE);
						curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => 'xxx','code' => 'xxx'));

						$res = curl_exec( $ch );
						curl_close( $ch );
						//$res  = curl_error( $ch );
						//var_dump($res);
			    	} else {
			    		$re =  file_get_contents($url);
			    	}			    	
			    	$count = $i+1;
			    }else{
			        $count = $i+1;
			    }
			$ofi = fopen($filei, "w+");
			fwrite($ofi, $count);
			fclose($ofi);   
	    }
	$filename = 'text.txt';
	$time = date("Y-m-d H:i:s",time());
	$word = $time."\r\n";
	$fh = fopen($filename, "a");
	fwrite($fh, $word);
	fclose($fh);

	sleep($interval);//每隔5分钟运行
}while(true);