<?php
$nowDate = date("Y-m-d H:i:s");					
$time2 = new DateTime($nowDate);
$time = new DateTime('2018-05-15 18:16:25');
					$timediff = $time->diff($time2);
					/*echo $timediff->s."<br/>";
					echo $timediff->i."<br/>";
					echo $timediff->h."<br/>";
					echo $timediff->d."<br/>";
					echo $timediff->m."<br/>";
					echo $timediff->y."<br/>";*/
$dateToHour = $timediff->d * 24;
echo $timediff->d; echo "<br>";
					echo $dateToHour;
?>