<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
		
		$auth = Yii::$app->authManager;

		// add the rule
		$rule = new \common\rbac\AuthorRule;
		$auth->add($rule);
        
        // add "managePost" permission
        $managePost = $auth->createPermission('managePost');
        $managePost->description = 'Manage post list';
        $auth->add($managePost);
		
		// add "viewPost" permission
        $viewPost = $auth->createPermission('viewPost');
        $viewPost->description = 'View a post';
        $auth->add($viewPost);
		
		// add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);
		
		// add "deletePost" permission
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);
		
		// add the "updateOwnPost" permission and associate the rule with it.
		$updateOwnPost = $auth->createPermission('updateOwnPost');
		$updateOwnPost->description = 'Update own post';
		$updateOwnPost->ruleName = $rule->name;
		$auth->add($updateOwnPost);
		
		// add the "deleteOwnPost" permission and associate the rule with it.
		$deleteOwnPost = $auth->createPermission('deleteOwnPost');
		$deleteOwnPost->description = 'Delete own post';
		$deleteOwnPost->ruleName = $rule->name;
		$auth->add($deleteOwnPost);

		// "updateOwnPost" will be used from "updatePost"
		$auth->addChild($updateOwnPost, $updatePost);

		// "deleteOwnPost" will be used from "deletePost"
		$auth->addChild($deleteOwnPost, $deletePost);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $managePost);
        $auth->addChild($author, $viewPost);
        $auth->addChild($author, $createPost);
		
		// allow "author" to update their own posts
		$auth->addChild($author, $updateOwnPost);
		
		// allow "author" to delete their own posts
		$auth->addChild($author, $deleteOwnPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $deletePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 2);
        $auth->assign($author, 3);
        $auth->assign($admin, 1);
    }
}
 
 