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
		$list = Model_Select::find(array(
			'order_by' => array(
				'id' => 'DESC',
			),
			'where' => array(
				array('question_id', '=', $q_id),
	        ),
		));

		return $list;
	}

    //選択肢一覧を配列で取得
	public static function getSelectList_byArray($q_id)
	{
		$list = Model_Select::find(array(
			'order_by' => array(
				'id' => 'DESC',
			),
			'where' => array(
				array('question_id', '=', $q_id),
	        ),
		));

		if (is_array($list)) {
			foreach ($list as $l) {
				$list_array[$l->id] = $l->desc;
			}
			return $list_array;
		}

		return;
	}

}