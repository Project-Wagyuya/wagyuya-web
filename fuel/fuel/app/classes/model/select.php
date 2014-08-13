<?php
/**
 * Created by PhpStorm.
 * User: Wada
 * Date: 2014/07/26
 * Time: 16:00
 */

class Model_Select extends Model_Base{

    //使用するtable
    protected static $_table_name = "selects";

	//選択肢一覧取得
	public static function getSelectList($q_id)
	{
		$list = DB::select()
					->from('selects')
					->where('question_id',$q_id)
					->order_by('id','DESC')
					->execute()
					->as_array();

		$a_allcount = Model_Answer::getAnswerAllCount($q_id);
		foreach ($list as $k => $l){
			$list[$k]['count'] = Model_Answer::getAnswerCount($l['id']);
			$list[$k]['per'] = ( $list[$k]['count'] / $a_allcount ) * 100;
		}

		return $list;
	}

}