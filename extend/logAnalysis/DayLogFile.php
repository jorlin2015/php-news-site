<?php
	namespace logAnalysis;

	/**
	 *多线程分析每天日志
	 */
	class DayLogFile/* extends \Thread*/
	{
		private static $paths = [
			// '/Users/zhangchaolin/Documents/study/php/log-238/localhost_access_log..',
			'/Users/zhangchaolin/Documents/study/php/log-15/localhost_access_log.'
		];
		function __construct($fileName, $result)
		{
			$this->fileName = $fileName;
			$this->result = $result;
			$this->result[$this->fileName] = $this->getDayActives();
		}
		// public function run(){
			// var_dump($this->result);
			// $this->result[$this->fileName] = $this->getDayActives();
		// }
		private function getDayActives(){
			$result = [];
			foreach (self::$paths as $index => $path) {
				$fileName = $path.$this->fileName.'.txt';
				// var_dump($fileName);
				$res = file_get_contents($fileName);
				preg_match_all('/images\/o.gif\?(.*action=page-access.*) HTTP\/1.1"/',$res,$matches);
				foreach ($matches[1] as $key => $value) {
					parse_str($value, $tempt);
					if(isset($tempt['uId'])){
						array_push($result,$tempt['uId']);
					}else{
						array_push($result,$tempt['teacher_id']);
					}
				}
			}
			return array_unique($result);
		}
	}
?>