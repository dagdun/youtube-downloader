<?php

$data = file_get_contents('https://www.youtube.com/get_video_info?el=vivo&sts=17316&video_id='.$_GET['v']);
// echo $data;
$arr = parseStr($data);
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

if ($arr['status'] == 'fail') {
	exit($arr['reason']);
}

if (!isset($arr['dashmpd'])) {
	exit('dashmpd fail');
}


echo '<h1>'.$arr['title'].'</h1>';
echo '<iframe src="https://www.youtube.com/embed/'.$_GET['v'].'" style="width:320px; height:240px; border:0"></iframe><br />';
echo '<span>views: '.number_format($arr['view_count']).' channel: '.$arr['author'].'</span><br>';

if (isset($arr['storyboard_spec'])) {
	list($story_url, $l0, $l1, $l2) = explode('|', $arr['storyboard_spec']);
	list($p1, $p2, $per_pic, $p4, $p5, $p6, $p7, $sigh) = explode('#', $l2);
	$qty = ceil($arr['length_seconds']/$per_pic)+2;
	echo '<a href="storyboard.php?url='.$story_url.'&sigh='.$sigh.'&qty='.$qty.'" target="blank">story board</a><br>';
}

if (isset($arr['dashmpd'])) {

	$dashmpd = @file_get_contents($arr['dashmpd']);

	if ($dashmpd) {
		$xml = new SimpleXMLElement($dashmpd);
		$json = json_decode( json_encode($xml), true);
		foreach ($json['Period']['AdaptationSet'] as $row) {
			echo '<h3>'.$row['@attributes']['mimeType'].'(only)</h3>';
			usort($row['Representation'], function($a, $b) {
				if (isset($a['@attributes']['height']))
					return $a['@attributes']['height'] < $b['@attributes']['height'];
				return $a['@attributes']['codecs'];
			});
			foreach ($row['Representation'] as $item) {
				$attr = $item['@attributes'];
				echo '<a href="'.$item['BaseURL'].'" target="blank">';

				if (isset($attr['codecs']))
					echo 'codecs: '.$attr['codecs'].',';
				if (isset($attr['audioSamplingRate']))
					echo 'sample: '.$attr['audioSamplingRate'].',';
				if (isset($attr['frameRate']))
					echo 'frame rate: '.$attr['frameRate'].',';
				if (isset($attr['height']))
					echo 'res: '.$attr['height'].'p';
				echo '</a><br>';
			}
		}
	}
}

if (isset($arr['url_encoded_fmt_stream_map']) && isset($arr['url_encoded_fmt_stream_map'][0]) && $arr['url_encoded_fmt_stream_map'][0] != '') {
	echo '<h3>mix</h3>';
	foreach ($arr['url_encoded_fmt_stream_map'] as $mix) {
		parse_str($mix, $m);
		echo '<a href="download.php?name='.urlencode($arr['title']).'&url='.urlencode($m['url']).'" target="blank">'.$m['type'].','.$m['quality'].'</a><br>';
	}
}
