<?php
namespace splider;

/**
 *爬虫
 **/
class Splider extends \Thread
{
	private static $baiduUrl = 'http://image.baidu.com/search/acjson';
	private static $public_path = __DIR__ . '/../../public/';
	public function __construct($keyword, $limit=30, $start=0, $flag=0){
        $this->keyword = $keyword;
        $this->limit = $limit;
        $this->start = $start;
        $this->flag = $flag;
    }
    public function run(){
    	$imgs = $this->getBaiduImg();
    	/*foreach ($imgs['images'] as $key => $value) {
    		printf("image %s:%s\n",$key,$value);
    	}
    	printf("This time total %s, success:%s\n",$imgs['total'],$imgs['success']);*/
    	// printf("limit:%s, start:%s\n", $this->limit, $this->start);
    }
	public function getBaiduImg(){
		$keyword = $this->keyword;
		$limit = $this->limit;
		$start = $this->start;
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
		return $this->saveImages($img_matches);
	}
	private function saveImages($img_matches){
		$start = $this->start;
		$public_path = self::$public_path;
	    $one_level_dir = date("Y");
	    $two_level_dir = $one_level_dir.'/'.date("m-d").'-'.$this->flag;
	    if(!is_dir($public_path.$one_level_dir)){
	        mkdir($public_path.$one_level_dir);
	    }
	    if(!is_dir($public_path.$two_level_dir)){
	        mkdir($public_path.$two_level_dir);
	    }
	    $option = array( 
	        'http' => array( 
	        'header' => "Referer:".self::$baiduUrl) 
	    ); 
	    $context = stream_context_create($option);
	    $result = [
	    	'images' => []
	    ];
		$count = 0;
	    foreach ($img_matches[0] as $key => $value) {
	    	$key = $start + $key;
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