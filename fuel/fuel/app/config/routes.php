<?php
return array(
	'_root_'  => 'top/index',  // The default route

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

	'q/create' => 'question/create',
	'q/create/confirm' => 'question/confirm',
	'q/create/commit' => 'question/commit',
	'q/:q_id' => 'question/detail',

	'q/:q_id/answer' => 'answer/index',
	'q/:q_id/answer/commit' => 'answer/commit',

	'_404_'   => 'top/404',    // The main 404 route
);