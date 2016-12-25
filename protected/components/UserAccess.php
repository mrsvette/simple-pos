<?php
class UserAccess
{
    const CREATE_PRIVILEDGE = 'create_p';
    const READ_PRIVILEDGE = 'read_p';
    const UPDATE_PRIVILEDGE = 'update_p';
    const DELETE_PRIVILEDGE = 'delete_p';

    public function hasAccess($controller, $user_id = 0, $role = 'read_p'){
        if($user_id == 0)
            $user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
		if(empty($user->hak_akses))
			return true;
		$hak_akses = CJSON::DECODE($user->hak_akses, true);

        return ($hak_akses['Basic'][ucfirst($controller)][$role] > 0)? true : false;
    }

	/**
	 * ruleAccess dipake pada accessRules controller
	 * array('allow',
	 *			'actions'=>array('index','view','create','update','admin','delete'),
	 *			'expression'=>'UserAccess::ruleAccess(\'priv_type\')==1',
	 *		),
	 */
	public function ruleAccess($priv)
	{
		$controller = strtolower(Yii::app()->controller->id);
		
		$akses = self::hasAccess($controller, Yii::app()->user->id, $priv);
		
		return (!Yii::app()->user->isGuest)? $akses : false;
	}
}
?>
