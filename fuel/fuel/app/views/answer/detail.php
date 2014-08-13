<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>アンケート経過/結果</title>
</head>
<body>

<h1>
	質問内容
</h1>
<b><? echo Model_Base::h($question['title']); ?></b><br>
<? echo Model_Base::h($question['desc']); ?><br>

<h1>
	経過/結果
</h1>
<?php
foreach ($selectList as $select)
{
?>
	<h3><? echo Model_Base::h($select['desc']); ?></h3>
	<li><? echo $select['per'].'%'; ?></li>
	<li><? echo $select['count'].'票'; ?></li>
<?php
}
?>

<br>
<? echo \Fuel\Core\Html::anchor('/q/' . $question['id'], 'アンケートに投票する');?><br>
<? echo \Fuel\Core\Html::anchor('/c_create/' . $question['id'], 'アンケートにコメントする');?><br>

<h1>
	コメント
</h1>
<?php
foreach ($commentList as $comment) {
	echo '<li>'.$comment['created_at'].'<br>';

	$c = Format::forge($comment)->to_array();
	if($c['select_id']){
		foreach ($selectList as $k => $s) {
			if (array_search($c['select_id'], $s)) {
				$key = $k;
			}
		}
		echo Model_Base::h($selectList[$key]['desc']).'派<br>';
	};

	echo Model_Base::h($comment['comment']).'<br></li><br>';
}
?>
<? echo \Fuel\Core\Html::anchor('/c/' . $question['id'], 'コメントをもっと見る');?>

</body>