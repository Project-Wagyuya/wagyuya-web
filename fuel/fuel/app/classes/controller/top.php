<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 16:10
 */

class Controller_Top extends Controller{

	public function action_index()
	{
		$newList = Model_Question::getNewList(5);

		$view = View::forge('top/index');
		$view->newList = $newList;
		return Response::forge($view);
	}

	public function action_404()
	{
//		return Response::forge(ViewModel::forge('top/404'), 404);
		return Response::forge(View::forge('top/404'), 404);
	}

} 