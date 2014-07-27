<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 16:44
 */

class Controller_Question extends Controller{

	public function action_detail()
	{
		$q_id = $this->param('q_id');
		error_log($q_id);
		$question = Model_Question::find_by_pk($q_id);
		$selectList = Model_Select::getSelectList($q_id);
		$selectList_byArray = Model_Select::getSelectList_byArray($q_id);
		$commentList = Model_Comment::getCommentList($q_id,'5');

		if (!$question)
		{
			throw new \Exception('Question Not found');
		}

		$view = View::forge('question/detail');
		$view->question = $question;
		$view->selectList = $selectList;
		$view->selectList_byArray = $selectList_byArray;
		$view->commentList = $commentList;

		return Response::forge($view);
	}

	public function action_create()
	{
		error_log('action_create');
		$question = new Model_Question();
		$time = time();
		$date = date('Y/m/d H:i:s');
		$question->title = 'Test Title ' . $date;
		$question->created_at = time();
//		$question->save();


	}


} 