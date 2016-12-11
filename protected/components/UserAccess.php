<?php
class UserAccess
{
    const CREATE_PRIVILEDGE = 'create_p';
    const READ_PRIVILEDGE = 'read_p';
    const UPDATE_PRIVILEDGE = 'update_p';
    const DELETE_PRIVILEDGE = 'delete_p';

    public function hasAccess($controller, $user_id = 0, $role = 'read'){
        if($user_id == 0)
            $user_id = Yii::app()->user->id;
        return true;
    }
}
?>