<?php
//$a = 'http://r5---sn-5np5po4v-c33k.googlevideo.com/videoplayback?expire=1497196599&ipbits=0&dur=268.760&lmt=1496740362376401&gcr=th&clen=127659704&itag=137&mime=video/mp4&gir=yes&key=yt6&ei=1xM9Wea1GoTIowPixqv4Bw&signature=500ECA0FE764CFC3C0456EB943BD4E2DE780525A.876DC58540E5BAF5295D01FB8FD68D3C807EEAB0&source=youtube&shardbypass=yes&initcwndbps=2337500&id=o-ABbYglC2zqlBZWt1cdP0nFUg640xQxbiW-YFwpUbeupI&pl=24&mm=31&mn=sn-5np5po4v-c33k&ms=au&mt=1497174928&sparams=clen,dur,ei,gcr,gir,hcs,id,initcwndbps,ip,ipbits,itag,lmt,mime,mm,mn,ms,mv,pl,shardbypass,source,expire&mv=m&ip=171.97.99.223&hcs=yes&signature=500ECA0FE764CFC3C0456EB943BD4E2DE780525A.876DC58540E5BAF5295D01FB8FD68D3C807EEAB0';
$a = 'https://r1---sn-5np5po4v-c33l7.googlevideo.com/videoplayback?dur=169.064&id=o-AH19EdDjuPH-pb86qWJQhuU8DAvG21aRv7_uXUmFauQx&pl=24&ms=au&sparams=dur%2Cei%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cratebypass%2Crequiressl%2Csource%2Cexpire&source=youtube&initcwndbps=2236250&mv=m&mm=31&ip=171.97.99.223&mn=sn-5np5po4v-c33l7&expire=1497203992&mt=1497182308&ipbits=0&mime=video%2Fmp4&ratebypass=yes&itag=22&signature=3CB552E63033039B19D8A4052F3D15EAC5D4B692.0D57E21A64D6D1EB5D0309080595EE794DC07D15&lmt=1472155224998127&requiressl=yes&ei=uDA9Wd-tJMbaowP387TgBg&key=yt6&ir=1&rr=12';
$b = 'https://r1---sn-5np5po4v-c33l7.googlevideo.com/videoplayback?id=6f54de082f8d05aa&itag=136&source=youtube&requiressl=yes&pl=24&ms=au&initcwndbps=2236250&mv=m&mm=31&mn=sn-5np5po4v-c33l7&ei=uDA9Wd-tJMbaowP387TgBg&ratebypass=yes&mime=video/mp4&gir=yes&clen=21817979&lmt=1452070969850223&dur=169.000&key=dg_yt0&mt=1497182308&signature=9E38A8EACDF30F454C595360C75B9649FD3C12.6F62DB6451EDFFF2DB32EAF3606019A8DAD82418&ip=171.97.99.223&ipbits=0&expire=1497203992&sparams=ip,ipbits,expire,id,itag,source,requiressl,pl,ms,initcwndbps,mv,mm,mn,ei,ratebypass,mime,gir,clen,lmt,dur&ir=1&rr=12';

parse_str(str_replace('?', '?&', $a), $a_arr);
parse_str(str_replace('?', '?&', $b), $b_arr);

$key = [];
foreach ($a_arr as $k => $v) 
	$key[] = $k;
foreach ($b_arr as $k => $v) 
	$key[] = $k;
$key = array_unique($key);

foreach ($key as $k) {
	echo '<ul>'.$k;
	echo '<li>a: '.(isset($a_arr[$k]) ? $a_arr[$k] : null).'</li>';
	echo '<li>b: '.(isset($b_arr[$k]) ? $b_arr[$k] : null).'</li>';
	echo '</ul>';
}
?>
