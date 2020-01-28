<?php 
/** Создаем файл нужного размера **
$filed = "keys_list0.txt";
$rez = "";
for($i = 1; $i < 250; $i++){ //250,000 ~ 10GB
	$rez .= "ключ".$i."\\tзначение".$i."\\x0A";
}
file_put_contents($filed, $rez);
var_dump($rez);
*/

function binary_search($file_dir, $search_key){
	$handle = fopen($file_dir, "r");
	while(!feof($handle)){
		$string = fgets($handle, 4000);
		$exstring = explode('\x0A', $string);
		array_pop($exstring);
		foreach ($exstring as $key => $value){
			$arr[] = explode('\t', $value);
		}
		$start = 0;
		$end = count($arr)-1;
		while($start <= $end){
				$mid = floor(($start + $end)/2);
				$strnatcmp = strnatcmp($arr[$mid][0], $search_key);
				
				if($strnatcmp > 0){
					$end = $mid - 1;
				} elseif ($strnatcmp == 0){
					return $arr[$mid][1];
				} else {
					$start = $mid + 1;
				}
		}
	}
	return 'undef';
}
$search_key = "ключ25";
$file_dir = dirname(__FILE__).'/keys_list0.txt';
echo "Ищем ключ25, такой есть в файле, нам вернет: ".binary_search($file_dir, $search_key)."</br>";
echo "Здесь пример ответа при поиска ключа, которого нет в файле: ".binary_search($file_dir, "ключ0999")."</br>";
?>
