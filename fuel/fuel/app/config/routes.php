<?php
return array(
	'_root_'  => 'top/index',  // The default route

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

	'q/create' => 'question/create',
	'q/create/confirm' => 'question/confirm',
	'q/create/commit' => 'question/commit',
	'q/:q_id' => 'question/detail',

	'a/:q_id' => 'answer/detail',
	'a_commit/:q_id' => 'answer/commit',

	'c/:q_id' => 'comment/detail',
	'c_create/:q_id' => 'comment/create',
	'c_create_confirm/:q_id' => 'comment/confirm',
	'c_create_commit/:q_id' => 'comment/commit',

	'_404_'   => 'top/404',    // The main 404 route
);