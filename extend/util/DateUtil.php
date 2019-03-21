<?php
namespace util;

/**
 * 日期工具函数
 */
class DateUtil
{
	public static function getMillisecond() {
    	list($t1, $t2) = explode(' ', microtime());
    	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}
}