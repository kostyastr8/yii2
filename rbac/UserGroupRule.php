<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    public $name = 'userGroup';
    const Admin = 1;
    const Manager = 2;
    const Client = 3;
    public function execute($user, $item, $params)
    {
//        $q = false;

        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->role;

            if ($item->name === 'admin') {
                return $q = ($group == self::Admin);
            } elseif ($item->name === 'manager') {
                return $q = ($group == self::Admin || $group == self::Manager);
//                print_r($q);
//                print_r($group);
//                print_r($item->name);
//                die;
            } elseif ($item->name === 'client') {
               return $q = ($group == self::Admin || $group == self::Manager || $group == self::Client);
            }
        }

        return true;
    }
}