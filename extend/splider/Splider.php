<?php
namespace splider;

/**
 *爬虫
 **/
class Splider
{
	private static $baiduUrl = 'http://image.baidu.com/search/acjson';
	public static function getBaiduImg($keyword, $limit=30, $start=0){
		$param = [
			'tn'=>'resultjson_com',
			'ipn'=>'rj',
			'queryWord'=>$keyword,
			'word'=>$keyword,
			'pn'=>$start,
			'rn'=>$limit
		];
		$url = self::$baiduUrl.'?'.http_build_query($param);
		$res = file_get_contents($url);
		preg_match_all('/(?<="thumbURL":")[^>"]*\.(?:png|jpg|bmp|gif|jpeg)/',$res,$img_matches);
		$public_path = ROOT_PATH . 'public/';
	    $one_level_dir = date("Y");
	    $two_level_dir = $one_level_dir.'/'.date("m-d");
	    if(!is_dir($public_path.$one_level_dir)){
	        mkdir($public_path.$one_level_dir);
	    }
	    if(!is_dir($public_path.$two_level_dir)){
	        mkdir($public_path.$two_level_dir);
	    }
	    $option = array( 
	        'http' => array( 
	        'header' => "Referer:".$url) 
	    ); 
	    $context = stream_context_create($option);
	    $result = [
	    	'images' => []
	    ];
		$count = 0;
	    foreach ($img_matches[0] as $key => $value) {
	        $ext = substr($value, strrpos($value, '.'));
	        if(strpos($value, 'http') === FALSE){
	            $value = 'http:'.$value;
	        }
	        $img = @file_get_contents($value, false, $context);
	        $new_file = $public_path.$two_level_dir.'/'.$key.$ext;
	        if($img && file_put_contents($new_file, $img)){
	            $count++;
	        	$src = '/'.$two_level_dir.'/'.$key.$ext;
	            $result['images'][$key] = $src;
	        }
	    }
	    $result['total'] = count($img_matches[0]);
	    $result['success'] = $count;
	    return $result;
	}
}