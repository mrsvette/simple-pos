<?php

/**
 * HakAksesForm class.
 * HakAksesForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class HakAksesForm extends CFormModel
{
    public $access;
    public $check_list;
    public $check_all;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('access, check_list, check_all', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'access' => 'Hak Akses',
        );
    }

    public function listAccess($user_id)
    {
        $user = User::model()->findByPk($user_id);
        $hak_akses = json_decode($user->hak_akses, true);

        $models = Crawler::getDataProvider(array('site'), false);
        $data = array();
        foreach($models as $id => $model){
            $module = $model['module'];
            $controller = $model['controller'];

            $data[$module][$controller] = array(
                'create_p' => ($hak_akses[$module][$controller]['create_p']>0)? true : false,
                'read_p' => ($hak_akses[$module][$controller]['read_p']>0)? true : false,
                'update_p' => ($hak_akses[$module][$controller]['update_p']>0)? true : false,
                'delete_p' => ($hak_akses[$module][$controller]['delete_p']>0)? true : false,
            );
        }

        return $data;
    }
}
