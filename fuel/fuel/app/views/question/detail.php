<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>アンケート詳細 / 投票</title>
</head>
<body>

<h1>
	アンケートに投票する
</h1>

<h2>
	質問内容
</h2>
<b><? echo $question->title; ?></b><br>

<h2>
	選択内容
</h2>
<?php
foreach ($selectList as $select)
{
	echo '<h3>'.$select->desc.'</h3>';

	echo Form::open(array('action'=>'answer/commit' ,'method'=>'post'));

	//コメント入力欄
	echo Form::textarea('comment','任意でコメントを入力ください',array('rows'=>3));
	echo '<br>';

	//submit
	echo Form::input('send',$select->desc.'に投票する',array('type'=>'submit'));

	//hidden
	echo Form::hidden('question_id',$question->id,array());
	echo Form::hidden('select_id',$select->id,array());

	echo Form::close();
}
?>
<br>
<?php echo \Fuel\Core\Html::anchor('/a/' . $question->id, '投票せずにアンケート経過を見る');?>
<h1>
	コメント
</h1>
<?php
foreach ($commentList as $comment)
{
	echo '<li>'.$comment['created_at'].'<br>';
	$c = Format::forge($comment)->to_array();
	if($c['select_id']){
		echo $selectList_byArray[$c['select_id']].'派<br>';
	};
	echo $comment['comment'].'<br></li><br>';
}
?>
<br>
<?php echo \Fuel\Core\Html::anchor('/c/' . $question->id, 'コメントをもっと見る');?><br>
<?php echo \Fuel\Core\Html::anchor('/c_create/' . $question->id, 'アンケートにコメントする');?><br>



</body>