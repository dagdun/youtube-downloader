<?php
$data = file_get_contents('https://www.youtube.com/get_video_info?el=info&sts=17316&video_id='.$_GET['v']);

function parseStr($data) {
	$datas = explode('&', $data);
	$result = [];
	foreach ($datas as $item) {
		list($key, $value) = explode('=', $item);
		if ($key == 'url_encoded_fmt_stream_map') {
			$result[$key] = explode(',', urldecode($value));
		} else {
			$result[$key] = urldecode($value);
		}
	}

	return $result;
}

function convertData($data) {
	$result = [];
	$arr = parseStr($data);
	foreach ($arr as $f => $v) {
		if (gettype($v) == 'array') {
			foreach ($v as $_v) {
				$result[$f][] = convertData($_v);
			}
		} else if (strpos($v, '&') !== false) {
			$result[$f] = convertData($v);
		} else if (substr($v, 0, 1) == '[' || substr($v, 0, 1) == '{') {
			$t = json_decode($v, true);
			if (json_last_error() === JSON_ERROR_NONE) {
				$result[$f] = json_decode($v, true);
			}
		} else {
			$result[$f] = $v;
		}

	}
	return $result;
}

$tmp = convertData($data);
var_dump($tmp);
?>
