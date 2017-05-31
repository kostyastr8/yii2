<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        $per_view1 = $authManager->createPermission('view1');
        $per_view1->description = 'per_view1';
        $authManager->add($per_view1);

        $authManager = \Yii::$app->authManager;
        $per_view2 = $authManager->createPermission('view2');
        $per_view2->description = 'per_view2';
        $authManager->add($per_view2);

        $authManager = \Yii::$app->authManager;
        $per_view3 = $authManager->createPermission('view3');
        $per_view3->description = 'per_view3';
        $authManager->add($per_view3);

//        $per_delete = $authManager->createPermission('delete');
//        $per_delete->description = 'per_delete';
//        $authManager->add($per_delete);

        // Create roles
        $admin  = $authManager->createRole('admin');
        $manager  = $authManager->createRole('manager');
        $client  = $authManager->createRole('client');

        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        $admin->ruleName  = $userGroupRule->name;
        $manager->ruleName  = $userGroupRule->name;
        $client->ruleName  = $userGroupRule->name;

        $authManager->add($client);
        $authManager->addChild($client, $per_view3);

        $authManager->add($manager);
        $authManager->addChild($manager, $per_view2);
        $authManager->addChild($manager, $client);

        $authManager->add($admin);
        $authManager->addChild($admin, $per_view1);
        $authManager->addChild($admin, $client);
        $authManager->addChild($admin, $manager);



        // Create simple, based on action{$NAME} permissions
//        $login  = $authManager->createPermission('login');
//        $logout = $authManager->createPermission('logout');
//        $error  = $authManager->createPermission('error');
//        $signUp = $authManager->createPermission('sign-up');
//        $index  = $authManager->createPermission('index');
//        $view   = $authManager->createPermission('view');
//        $update = $authManager->createPermission('update');
//        $delete = $authManager->createPermission('delete');



        // Add permissions in Yii::$app->authManager
//        $authManager->add($login);
//        $authManager->add($logout);
//        $authManager->add($error);
//        $authManager->add($signUp);
//        $authManager->add($index);
//        $authManager->add($view);
//        $authManager->add($update);
//        $authManager->add($delete);


        // Add rule, based on UserExt->group === $user->group


        // Add rule "UserGroupRule" in roles
//        $guest->ruleName  = $userGroupRule->name;
//        $brand->ruleName  = $userGroupRule->name;
//        $talent->ruleName = $userGroupRule->name;


        // Add roles in Yii::$app->authManager
//        $authManager->add($guest);
//        $authManager->add($brand);
//        $authManager->add($talent);


        // Add permission-per-role in Yii::$app->authManager
//        // Guest
//        $authManager->addChild($guest, $login);
//        $authManager->addChild($guest, $logout);
//        $authManager->addChild($guest, $error);
//        $authManager->addChild($guest, $signUp);
//        $authManager->addChild($guest, $index);
//        $authManager->addChild($guest, $view);

//        // BRAND
//        $authManager->addChild($brand, $update);
//        $authManager->addChild($brand, $guest);
//
//        // TALENT
//        $authManager->addChild($talent, $update);
//        $authManager->addChild($talent, $guest);
//
//        // Admin
//        $authManager->addChild($admin, $delete);
//        $authManager->addChild($admin, $talent);
//        $authManager->addChild($admin, $brand);
    }
}