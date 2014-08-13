<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 14:35
 */

class Model_Comment extends Model_Base{

	//使用するtable
	protected static $_table_name = "comments";

	//コメント一覧取得
	public static function getCommentList($q_id, $limit='10')
	{
		$list = DB::select()
					->from('comments')
					->where('question_id',$q_id)
					->order_by('created_at', 'DESC')
					->limit($limit)
					->execute()
					->as_array();

		return $list;
	}

	//コメント保存
	public static function saveComment($data)
	{
		$result = DB::insert('comments')
					->set(array(
						'question_id'=>$data['question_id'],
						'comment'=>$data['comment'],
						'created_at'=>$data['date'],
					))
					->execute();
		if ($result[1] < 1) {
			//準備中
			$result = 'false';
		}

		return $result;
	}


}