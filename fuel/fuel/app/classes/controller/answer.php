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
		$question = Model_Question::getQuestionByKey($q_id);
		$selectList = Model_Select::getSelectList($q_id);
		$commentList = Model_Comment::getCommentList($q_id,'5');

		if (!$question) {
			throw new \Exception('Question Not found');
		}

		$view = View::forge('answer/detail');
		$view->question = $question;
		$view->selectList = $selectList;
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

		//CSRF対策
		if(Security::check_token()) {
			$result = Model_Answer::saveAnswer($post);
			if ($result == 'false') {
				//準備中
				echo 'DBエラー';
			}

			return Response::redirect('/a/'.$post['question_id'], 'refresh');
		} else {
			//不正なポストのときの処理を入れること
			echo "不正なポスト";
		}

	}



}