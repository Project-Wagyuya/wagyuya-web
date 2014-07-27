<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 14:35
 */

class Model_Answer extends Model_Base{

    //使用するtable
    protected static $_table_name = "answers";


	//回答一覧：使用する予定なし
	public static function getAnswerList($q_id)
	{
		$list = Model_Answer::find(array(
			'order_by' => array(
				'id' => 'DESC',
			),
			'where' => array(
				array('question_id', '=', $q_id),
			),
		));

		return $list;
	}


	//選択肢に対する回答数
	public static function getAnswerResult($s_id)
	{
		$result = DB::select(DB::expr('COUNT(select_id) as count'))->from('answers')->where('select_id',$s_id)->execute();
		foreach ($result as $r) {
			$num = $r['count'];
		}
		return $num;
	}


	//質問に対する全回答数
	public static function getAnswerAll($q_id)
	{
		$result = DB::select(DB::expr('COUNT(*) as count'))->from('answers')->where('question_id',$q_id)->execute();
		foreach ($result as $r) {
			$num = $r['count'];
		}
		return $num;
	}


	//回答保存
	public static function saveAnswer($data)
	{
		$result1 = DB::insert('answers')
					->set(array(
						'question_id'=>$data['question_id'],
						'select_id'=>$data['select_id'],
						'created_at'=>$data['date'],
					))
					->execute();
		if ($result1[1] < 1) {
			//準備中
			$result = 'false';
		}

		$result2 = DB::insert('comments')
					->set(array(
						'question_id'=>$data['question_id'],
						'select_id'=>$data['select_id'],
						'comment'=>$data['comment'],
						'created_at'=>$data['date'],
					))
					->execute();
		if ($result2[1] < 1) {
			//準備中
			$result = 'false';
		}

		$result = 'true';
		return $result;
	}

}