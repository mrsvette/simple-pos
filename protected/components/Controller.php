<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    /**
     * clean string from non alphanumeric
     */
    public function alphaNumeric($string, $replace = '+')
    {
        return preg_replace("/[\/\&%#\$]/", $replace, $string);
    }

    /**
     * unformat money format to base number
     */
    public function money_unformat($number, $thousand = '.', $decimal = ',')
    {
        if (strstr($number, $thousand))
            $number = str_replace($thousand, '', $number);
        if (strstr($number, $decimal))
            $number = str_replace($decimal, '.', $number);
        return $number;
    }

    /**
     * clean string
     */
    public function cleanNumber($string, $replace = '+')
    {
        return preg_replace("/[\/\&%#* \$]/", $replace, $string);
    }

    /**
     * clean string
     */
    public function cleanString($string, $replace = '+')
    {
        return preg_replace("/[\/\&%#*\$']/", $replace, $string);
    }

    /**
     * format money format to base number
     */
    public function money_format($number, $thousand = '.', $decimal = ',')
    {
        $number = number_format($number, 2, $decimal, $thousand);
        return $number;
    }
}