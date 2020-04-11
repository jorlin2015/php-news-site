<?php
namespace logAnalysis;

require_once('DayLogFile.php');
// require_once('StorageData.php');
use logAnalysis\DayLogFile;
// use logAnalysis\StorageData;
/**
* 统计教师空间日活,月活
*/
class LogAnalysis
{
	// private $pSize = 5;
	// private $pools = [];
	function __construct($start, $end){
		$this->start = $start;
		$this->end = $end;
		$this->result = [];
		// $this->result = new StorageData();
	}
	public function analysisByDay(){
		$dates = $this->getDays();
		$this->days = count($dates);
		// $this->enterPools($dates);
		//线程池没满就新建线程加入线程池,否则等待线程池有空闲
		while (count($dates) > 0) {
			// foreach ($this->pools as $key => $worker) {
				// if(!$worker->isrunning()){
					$fileName = array_shift($dates);
					/*$pools[$key] = */new DayLogFile($fileName, $this->result);
					// $pools[$key]->start();
				// }
			// }
			// usleep(1000);
		}
		$sum = 0;
		foreach ($this->result as $key => $value) {
			/*foreach ($value as $key1 => $value1) {
				$sum += $value1;
			}*/
			$sum += count($value);
		}
		/*var_dump($sum);
		var_dump($this->days);*/
		var_dump(round($sum / $this->days));
	}
	// private function enterPools($dates){
	// 	$size = $this->pSize > $this->days ? $this->pSize : $this->days;
	// 	if(count($this->pools) < $size){
	// 		$fileName = array_shift($dates);
	// 		$work = new DayLogFile($fileName, $this->result);
	// 		array_push($this->pools, $work);
	// 		$work->start();
	// 	}
	// }
	public function analysiByMonth(){
		$uniq = [];
		foreach ($this->result as $key => $value) {
			foreach ($value as $key1 => $value1) {
				array_push($uniq, $value1);
			}
		}
		$uniq = array_unique($uniq);
		var_dump(count($uniq));
	}
	private function getDays(){
		$date1 = date_create($this->start);
		$date2 = date_create($this->end);
		$diff = date_diff($date2, $date1);
		$days = $diff->format('%a');
		$result = [date_format($date1, 'Y-m-d')];
		for ($i=0; $i < $days; $i++) {
			date_add($date1, date_interval_create_from_date_string('1 days'));
			array_push($result, date_format($date1, 'Y-m-d'));
		}
		return $result;
	}
}
$obj = new LogAnalysis('2019-01-01', '2019-01-31');
$obj->analysisByDay();
$obj->analysiByMonth();
?>