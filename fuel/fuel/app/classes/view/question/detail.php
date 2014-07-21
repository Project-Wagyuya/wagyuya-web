<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 17:19
 */

namespace Fuel\classes\view\question;


class View_Question_Detail {

	public function view()
	{
		$this->question = $this->request()->param('name', 'World');
	}
}