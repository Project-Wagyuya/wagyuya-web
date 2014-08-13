<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>コメント内容</title>
</head>
<body>

<h1>
	質問内容
</h1>
<b><? echo $question['title']; ?></b><br>
<? echo $question['desc']; ?><br>
<?php
foreach ($selectList as $select)
{
?>
	<h3><? echo Model_Base::h($select['desc']); ?></h3>
<?php
}
?>
<br>

<h1>コメント</h1>

<?php
	echo Form::open(array('action'=>'comment/commit' ,'method'=>'post'));

	//コメント入力欄 
	echo Form::textarea('comment','コメントを入力ください',array('rows'=>3));
	echo '<br>';

	//submit
	echo Form::input('send','コメントを投稿',array('type'=>'submit'));

	//hidden
	echo Form::hidden('question_id', $question['id'], array());
	echo Form::hidden($csrf['token_key'], $csrf['token'], array());

	echo Form::close();
?>


</body>