<?php
function curl_json($url){ //функция обращения
$myCurl = curl_init();
curl_setopt_array($myCurl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(/*здесь массив параметров запроса*/))
));
$response = curl_exec($myCurl);
return $response;
curl_close($myCurl);
}

$variable =	json_decode(curl_json('https://slack.com/api/conversations.history?token=xoxp-299111059777-300515217942-299790778661-99f828e20c2ea114abe5fc022f0c6acf&channel=C8TGG93MH&pretty=1'));

for ($i =1; $i < count($variable->messages); $i++){
		$array[$variable->messages[$i]->user] = 0;
}
$key_name = array_keys($array); //меняем местами ключ и значение
for($i=0; $i<count($array); $i++){
	for($m = 0; $m <count($variable->messages); $m++){
		if($key_name[$i] == $variable->messages[$m]->user){
			$array[$key_name[$i]] +=1;
		}
	}
}
echo '<table border="1">';
echo '<tr><td>Имя пользователя</td><td>Количество сообщений</td></tr>';
foreach($array as $key => $value){
$variab =	json_decode(curl_json('https://slack.com/api/users.info?token=xoxp-299111059777-300515217942-299790778661-99f828e20c2ea114abe5fc022f0c6acf&user='.$key.'&pretty=1'));
	echo '<tr><td>'.$variab->user->name.'</td><td>'.$value.'</td></tr>';
}
echo  '</table>';
?>