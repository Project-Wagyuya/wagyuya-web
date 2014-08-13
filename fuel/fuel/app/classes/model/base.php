<?php
/**
 * Created by PhpStorm.
 * User: Nakayama
 * Date: 2014/07/21
 * Time: 15:25
 */

class Model_Base extends \Fuel\Core\Model_Crud{

	public static function h($string){
		return htmlspecialchars($string);
	}

}