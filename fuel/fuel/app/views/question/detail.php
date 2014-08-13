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
<b><? echo Model_Base::h($question['title']); ?></b><br>

<h2>
	選択内容
</h2>
<?php
foreach ($selectList as $select)
{
	echo '<h3>'.Model_Base::h($select['desc']).'</h3>';

	echo Form::open(array('action'=>'answer/commit' ,'method'=>'post'));

	//コメント入力欄
	echo Form::textarea('comment','任意でコメントを入力ください',array('rows'=>3));
	echo '<br>';

	//submit
	echo Form::input('send',Model_Base::h($select['desc']).'に投票する',array('type'=>'submit'));

	//hidden
	echo Form::hidden('question_id',$question['id'],array());
	echo Form::hidden('select_id',$select['id'],array());
	echo Form::hidden($csrf['token_key'], $csrf['token'], array());

	echo Form::close();
}
?>
<br>
<? echo \Fuel\Core\Html::anchor('/a/' . $question['id'], '投票せずにアンケート経過を見る');?>

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
<br>
<? echo \Fuel\Core\Html::anchor('/c/' . $question['id'], 'コメントをもっと見る');?><br>
<? echo \Fuel\Core\Html::anchor('/c_create/' . $question['id'], 'アンケートにコメントする');?><br>

</body>