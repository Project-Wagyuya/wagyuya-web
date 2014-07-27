<?php
/**
 * Created by PhpStorm.
 * User: Wada
 * Date: 2014/07/26
 * Time: 18:00
 */

class Controller_Answer extends Controller{

	public function action_detail()
	{
		$q_id = $this->param('q_id');
		error_log($q_id);
		$question = Model_Question::find_by_pk($q_id);
		$selectList = Model_Select::getSelectList($q_id);
		$answerAll = Model_Answer::getAnswerAll($q_id);
		$selectList_byArray = Model_Select::getSelectList_byArray($q_id);
		$commentList = Model_Comment::getCommentList($q_id,'5');
		foreach ($selectList as $select){
			$select->count = Model_Answer::getAnswerResult($select->id);
			$select->per = ( $select->count / $answerAll ) * 100;
		}

		if (!$question)
		{
			throw new \Exception('Question Not found');
		}

		$view = View::forge('answer/detail');
		$view->question = $question;
		$view->answerAll = $answerAll;
		$view->selectList = $selectList;
		$view->selectList_byArray = $selectList_byArray;
		$view->commentList = $commentList;

		return Response::forge($view);
	}

	public function action_commit()
	{
		$post = Input::post();
		$post['date'] = date("YmdHis");
		if(empty($post)){
			//準備中
			throw new \Exception('投票に失敗しました');
		}

		$result = Model_Answer::saveAnswer($post);
		if ($result == 'false') {
			//準備中
			echo 'DBエラー';
		}

		return Response::redirect('/a/'.$post['question_id'], 'refresh');

	}



}