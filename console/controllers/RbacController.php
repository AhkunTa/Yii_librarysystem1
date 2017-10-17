<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18 0018
 * Time: 21:15
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $bookController = $auth->createPermission('bookController');
        $bookController->description = '图书管理';
        $auth->add($bookController);


        $borrowController = $auth->createPermission('borrowController');
        $borrowController->description = '借阅管理';
        $auth->add($borrowController);


        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = '修改用户';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = '删除用户';
        $auth->add($deleteUser);



        $updateAdmin = $auth->createPermission('updateAdmin');
        $updateAdmin->description = '修改管理员';
        $auth->add($updateAdmin);

        $resetPassword = $auth->createPermission('resetPassword');
        $resetPassword->description = '重置密码';
        $auth->add($resetPassword);

        $adminPermission = $auth->createPermission('adminpPermission');
        $adminPermission->description = '权限设置';
        $auth->add($adminPermission);

        $createAdmin = $auth->createPermission('createAdmin');
        $createAdmin->description = '创建管理员';
        $auth->add($createAdmin);



        // 普通管理员具有 图书管理 借阅管理 和用户管理
        $commonAdmin = $auth->createRole('commonAdmin');
        $commonAdmin->description = '普通管理员';
        $auth->add($commonAdmin);
        $auth->addChild($commonAdmin, $updateUser);
        $auth->addChild($commonAdmin, $deleteUser);
        $auth->addChild($commonAdmin, $bookController);
        $auth->addChild($commonAdmin, $borrowController);

        //高级管理员具有更新 修改 重置密码 权限控制
        $advanceAdmin = $auth->createRole('advanceAdmin');
        $advanceAdmin->description = '高级管理员';
        $auth->add($advanceAdmin);
        $auth->addChild($advanceAdmin, $updateAdmin);
        $auth->addChild($advanceAdmin, $resetPassword);
        $auth->addChild($advanceAdmin, $adminPermission);
        $auth->addChild($advanceAdmin, $createAdmin);



        $superAdmin = $auth->createRole('superAdmin');
        $superAdmin->description = '超级管理员';
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $advanceAdmin);
        $auth->addChild($superAdmin, $commonAdmin);

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。

        $auth->assign($superAdmin, 1);
        $auth->assign($advanceAdmin, 2);
        $auth->assign($commonAdmin, 3);
        $auth->assign($commonAdmin, 4);
        $auth->assign($commonAdmin, 5);

    }
}