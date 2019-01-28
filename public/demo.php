<?php
/**
 * 多线程示例
 * @author PHPHa<mail@phpha.com>
 * @date 2016年8月15日
 * @copyright http://blog.phpha.com
 */

//继承父类
class Test extends Thread{
    
    public function __construct($arg){
        $this->arg = $arg;
    }
    
    public function run(){
        if($this->arg){
            //休眠[100]毫秒/否则效果不明显
            usleep(100000);
            echo $this->arg, PHP_EOL;
        }
    }
}

//多线程版本
$script_stime = getMicroTime();
//创建线程
for($i = 0; $i < 100; $i++){
    $pool[$i] = new Test($i);
    $pool[$i]->start();
}
//线程同步
foreach($pool as $work){
    while($work->isRunning()){
        usleep(10);
    }
    $work->join();
}
//输出执行时间
echo '[multi]', outputTimes(), PHP_EOL;

//脚本开始时间
$script_stime = getMicroTime();
//单线程版本
for($i = 0; $i < 100; $i++){
    $Obj = new Test($i);
    $Obj->run();
}
//输出执行时间
echo '[single]', outputTimes(), PHP_EOL;

//GET_MICRO_TIME
function getMicroTime(){
    return round(microtime(true), 3);
}

//OPTPUT_EXECUTE_TIMES
function outputTimes(){
    global $script_stime;
    return sprintf('EXECUTE_TIMES: %.3fs', getMicroTime() - $script_stime);
}