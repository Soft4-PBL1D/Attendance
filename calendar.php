<?php
	$year = @$_GET['year'];
	$month = @$_GET['month'];

	$monthNum = getMonthDayNum($year, $month);
	$dayPointer = 0 - getStartDate($year, $month, 1);


	function getMonthDayNum($year, $month) {
		switch ($month) {
			case 2:
				return (isLeapYear($year) ? 29 : 28);
				break;
			case 4:
			case 6:
			case 9:
			case 11:
				return 30;
				break;
			default:
				return 31;
				break;
		}
	}
	function isLeapYear ( $year ) {
		if( ( $year % 4 == 0 && $year % 100 != 0 ) || $year % 400 == 0 ) {
			return true;
		} else {
			return false;
		}
	}

	function getStartDate($y, $m, $d) {
		$y = intval( $y );
		$m = intval( $m );
		$d = intval( $d );
		if( $m == 1 or $m == 2 ){
			$y -= 1;
			$m += 12;
		}
		$res = ( $y + intval( $y / 4 ) - intval( $y / 100 ) + intval( $y / 400 ) + intval( ( 13 * $m + 8 ) / 5 ) + $d ) % 7;
		return $res;    
	}	
?>


<html>
	<head>
		<link rel='stylesheet' href='cstyle.css'>
	</head>

	<body>

	<h2 class='title'><?php echo "{$year}年{$month}日" ?></h2>
	<hr class='calendar_hr'>
	<span class='day date'>日</span><span class='day date'>月</span><span class='day date'>火</span><span class='day date'>水</span><span class='day date'>木</span><span class='day date'>金</span><span class='day date'>土</span>
<?php
	for ($i = 0; $i < 6; $i++) {
		echo "<div class='week'>";
		for ($j = 0; $j < 7; $j++) {
			if ($dayPointer > $monthNum) {
				break;
			}
			$restClass = '';
			if ($j == 0 || $j == 6) {
				$restClass = ' holid';
			}
			if ($dayPointer < 0) {
				$prevDay = getMonthDayNum(($month == 1 ? $year - 1 : $year), ($month == 1 ? 12 : $month - 1)) + $dayPointer + 1;
				echo "<span class='day$restClass'><span class='text prev'>{$prevDay}日</span></span>";
				$dayPointer++;	
				continue;
			}
			echo "<span class='day$restClass'><span class='text'>{$dayPointer}日</span></span>";
			
			$dayPointer++;	

		}
		echo "</div>";
	}
?>
	</body>

</html>
