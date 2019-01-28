<?php
namespace splider;

require_once('Splider.php');

use splider\Splider;
function getMicroTime(){
    return round(microtime(true), 3);
}
class Enter{
	private static $page_num = 1;
	public function baduImage($pages=1, $keyword="田园自然风光"){
		$page_num = self::$page_num;
		$pool = [];
		$script_stime = getMicroTime();
		//创建线程
		for($i = 0; $i < $pages; $i++){
			$pool[$i] = new Splider($keyword, $page_num, $i * $page_num, 0);
			$pool[$i]->start();
		}
		//线程同步
		foreach($pool as $work){
		    while($work->isRunning()){
		        usleep(10);
		    }
		    $work->join();
		}
		printf("multi threads times: %.3fs\n", getMicroTime() - $script_stime);
		//单线程
		$pool = [];
		$script_stime = getMicroTime();
		for($i = 0; $i < $pages; $i++){
			$pool[$i] = new Splider($keyword, $page_num, $i * $page_num, 1);
			$pool[$i]->run();
		}
		printf("single thread times: %.3fs\n", getMicroTime() - $script_stime);
	}
}

$obj = new Enter();
$obj->baduImage(100, '萌娃');
?>