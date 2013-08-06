<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
require_once 'me2php/Me2.php';
include "libchart/classes/libchart.php";

Me2Api::$applicationKey = '86b73d23119e3525e10e991999b5c851';


global $times,$days,$name;
$times=array();
$days=array();

function inittimes()
{
	global $times;
	for($i=0;$i<24;$i++){
		$times[$i]=0;
	}
}

function initdays()
{
	global $days;
	for($i=1;$i<8;$i++){
		$days[$i]=0;
	}
}

function maketimesgraph($title)
{
	global $times;

//	ob_start();
	
	$chart = new VerticalBarChart();

	$dataSet = new XYDataSet();
	for($i=0;$i<24;$i++){
		$t=$i."시~".(($i)+1)."시";
		$dataSet->addPoint(new Point($t, $times[$i]));
	}
	print_r($dataSet);
	$chart->setDataSet($dataSet);

	$chart->setTitle($title);

	$chart->render("generated/demo1.png");
//	ob_end_clean();
}

function makedaysgraph($title)
{
	global $days;
	ob_start();
	

	$chart = new PieChart(450,250);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("월요일", $days[1]));
	$dataSet->addPoint(new Point("화요일", $days[2]));
	$dataSet->addPoint(new Point("수요일", $days[3]));
	$dataSet->addPoint(new Point("목요일", $days[4]));
	$dataSet->addPoint(new Point("금요일", $days[5]));
	$dataSet->addPoint(new Point("토요일", $days[6]));
	$dataSet->addPoint(new Point("일요일", $days[7]));
	$chart->setDataSet($dataSet);

	$chart->setTitle($title);
	$chart->render("generated/demo3.png");
	ob_end_clean();
}

function process($userid,$graph=1)
{
	global $times,$days,$name;
	
	$user = new Me2Person($userid);
	$name=$user->nick;
	$p=$user->posts->between(
        new DateTime('2006-09-01'),
        new DateTime('2008-09-17')
    );

    inittimes();
   	foreach($p as $post){
		$times[($post->createdAt->format('G'))]++;
	}
//	print_r($times);
	if($graph)
		maketimesgraph($name."님은 언제 미투데이를 하실까?");
	
	initdays();
	foreach($p as $post){
		$days[($post->createdAt->format('N'))]++;
	}
	if($graph)
		makedaysgraph($name."님은 무슨 요일에 미투데이를 하실까?");	
}

function friends()
{
	
}

?>

<?
	process($_REQUEST["userid"]);
    //    $user->posts['tag']->between('2007-08-01', mktime(0, 0, 0, 9, 10, 2007))


//	$stack=array();

//	foreach($user->friends as $f){
//		array_push($stack,$f->name);
//	}
//print_r($stack);

//echo version_compare(PHP_VERSION, '5.1', '>=') && extension_loaded('spl') && extension_loaded('simplexml') ? 'okay' : 'sorry';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>HOYAJIGI's ME&FRIENDS 2 TIME&DAY</title>
</head>
<body>
	<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;"/>
	<img alt="Pie chart"  src="generated/demo3.png" style="border: 1px solid gray;"/>
</body>
</html>
