<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 14:35
 */

class Model_Question extends Model_Base{

    //使用するtable
    protected static $_table_name = "questions";

    //プライマリキー
    protected static $_primary_key = "id";


	public static function getNewList($count = 5)
	{
		$list = Model_Question::find(array(
			'order_by' => array(
				'id' => 'DESC',
			),
			'limit' => $count,
		));

		return $list;
	}

}