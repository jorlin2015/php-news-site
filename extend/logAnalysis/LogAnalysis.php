<?php
namespace logAnalysis;

/**
* 统计教师空间日活,月活
*/
class ActiveUsers
{
	
	private static $path = 'E:\log-238\localhost_access_log..';
	function __construct($start, $end){
		$this->start = $start;
		$this->end = $end;
	}
	// private static $path = 'E:\log.txt';
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
	public function analysisByDay(){
		$dates = $this->getDays();
		$sum = 0;
		foreach ($dates as $key => $value) {
			$matches = $this->getMatches(self::$path.$value.'.txt');
			$actives = $this->getDayActives($matches[1]);
			$sum += count($actives);
		}
		print_r(round($sum / count($dates)));
	}
	private function getMatches($fileName){
		$res = file_get_contents($fileName);
		preg_match_all('/images\/o.gif\?(.*action=page-access.*) HTTP\/1.1"/',$res,$matches);
		return $matches;
	}
	private function getDayActives($data){
		$result = [];
		foreach ($data as $key => $value) {
			parse_str($value, $tempt);
			// print_r($tempt['uId']);
			if(isset($tempt['uId'])){
				array_push($result,$tempt['uId']);
			}else{
				array_push($result,$tempt['teacher_id']);
			}
		}
		return array_unique($result);
	}
}
$obj = new ActiveUsers('2019-01-01', '2019-01-31');
$obj->analysisByDay();
?>