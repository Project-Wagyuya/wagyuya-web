<?php
/**
 * Created by PhpStorm.
 * User: Wada
 * Date: 2014/07/26
 * Time: 18:00
 */

class Controller_Comment extends Controller{

	public function action_detail()
	{
		$q_id = $this->param('q_id');
		error_log($q_id);
		$question = Model_Question::getQuestionByKey($q_id);
		$selectList = Model_Select::getSelectList($q_id);
		$commentList = Model_Comment::getCommentList($q_id);

		if (!$question)
		{
			throw new \Exception('Question Not found');
		}

		$view = View::forge('comment/detail');
		$view->question = $question;
		$view->selectList = $selectList;
		$view->commentList = $commentList;

		return Response::forge($view);
	}


	public function action_create()
	{
		$q_id = $this->param('q_id');
		error_log($q_id);
		$question = Model_Question::getQuestionByKey($q_id);
		$selectList = Model_Select::getSelectList($q_id);

		//CSRF対策
		$csrf['token_key'] = Config::get('security.csrf_token_key');
		$csrf['token'] = Security::fetch_token();

		$view = View::forge('comment/create');
		$view->question = $question;
		$view->selectList = $selectList;
		$view->csrf = $csrf;

		return Response::forge($view);
	}


	public function action_commit()
	{
		$post = Input::post();
		$post['date'] = date("YmdHis");
		if(empty($post)){
			//準備中
			throw new \Exception('コメントをきちんと入力ください');
		}

		//CSRF対策
		if(Security::check_token()) {
			$result = Model_Comment::saveComment($post);
			if ($result == 'false') {
				//準備中
				echo 'DBエラー';
			}

			return Response::redirect('/c/'.$post['question_id'], 'refresh');
		} else {
			//不正なポストのときの処理を入れること
			echo "不正なポスト";
		}

	}


}