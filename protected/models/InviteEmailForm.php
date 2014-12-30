


<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class InviteEmailForm extends CFormModel
{
	public $contactids = array();
	public function rules()
	{
		return array(
		array('contactids','type','type'=>'array','allowEmpty'=>true),
		);
	}
}
