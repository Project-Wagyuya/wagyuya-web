<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>VOTE TOP</title>
</head>
<body>

<h1>
	みんなのアンケート（仮）
</h1>

<ul>
<?php
foreach ($newList as $question)
{
?>
	<li><?php echo \Fuel\Core\Html::anchor('/q/' . $question->id, $question->title);?></li>
<?php
}
?>
</ul>


</body>