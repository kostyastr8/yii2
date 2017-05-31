<?php
use \app\rbac\UserProfileOwnerRule;

// add the rule
$userProfileOwnerRule = new UserProfileOwnerRule();
$authManager->add($userProfileOwnerRule);

$view1 = $authManager->createPermission('view1');
$view1->ruleName = $userProfileOwnerRule->name;
$authManager->add($view1);

$authManager->addChild($admin, $view1);
