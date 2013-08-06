<?
include "libchart/classes/libchart.php";
	$times=arrayArray ( [i] => 0 [18] => 33 [1] => 117 [2] => 56 [9] => 19 [14] => 34 [15] => 40 [16] => 46 [17] => 47 
	[19] => 42 [23] => 62 [8] => 34 [12] => 48 [0] => 89 [11] => 49 [13] => 40 [20] => 34 [21] => 32 [3] => 8 [22] => 61 
	[7] => 2 [10] => 30 [5] => 10 [4] => 1 ) ;
	$times=array();
	$chart = new VerticalBarChart();

	$dataSet = new XYDataSet();
	for($i=0;$i<24;$i++){
		$t=$i."½Ã~".(($i)+1)."½Ã";
		$dataSet->addPoint(new Point($t, $times[$i]));
	}
	print_r($dataSet);
	$chart->setDataSet($dataSet);

	$chart->setTitle($title);

	$chart->render("generated/demo1.png");
?>