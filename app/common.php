<?php 
/**
 * 保证数组里每个键都有默认值
 * @param  array &$data 源数据
 * @param  string $key   键名
 * @param  string $value 默认值
 * @return [type]        [description]
 */
function def(&$data,$key,$value='')
{
	if(is_array($key)){
		foreach ($key as $item) {
			$data[$item]=!empty($data[$item]) ? $data[$item] : $value;
		}
		return;
	}
	return !empty($data[$key]) ? $data[$key] : $value;
}