<?php

function DaumMap_Header($target) {
	global $configVal, $pluginURL;
	requireComponent('Textcube.Function.Setting');
	$config = setting::fetchConfigVal($configVal);
	if (!is_null($config) && isset($config['apiKey'])) {
		$api_key = $config['apiKey'];
		$target .= "<script type=\"text/javascript\" src=\"http://apis.daum.net/maps/maps2.js?apikey=$api_key\"></script>\n";
	}
	return $target;
}





















function DaumMap_View($target, $mother) {
//	echo $target;
	preg_match('/\[##_Map\|(([^|]+)\|)?_##\]/', $target, $matches, PREG_OFFSET_CAPTURE, $offset);
//	echo $matches[2][0];
	$result=json_decode($matches[2][0],true);
	
	print_r($result);
	
	return $target;
}









DaumMap_View('[##_Map|{"center": {"latitude":37.51901889320427,"longitude":126.94285869598389},"zoom":15,"width":450,"height":400,"type":"G_HYBRID_MAP","user_markers": [{"title":"토끼굴","desc":"토끼가 살아요","lat":37.51626173528878,"lng":126.94090604782104}]}|_##]',"");
//echo "아아";



function DaumMap_ConfigHandler($data) {
	return true;
	requireComponent('Textcube.Function.Setting');
	$config = Model_Setting::fetchConfigVal($data);
	if (!is_numeric($config['latitude']) || !is_numeric($config['longitude']) ||
		$config['latitude'] < -90 || $config['latitude'] > 90 || $config['longitude'] < -180 || $config['longitude'] > 180)
		return '위도 또는 경도의 값이 올바르지 않습니다.';
	return true;
}

?>
