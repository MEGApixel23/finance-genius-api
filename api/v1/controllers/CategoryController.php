<?php

namespace api\v1\controllers;

use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\models\Category;
use api\v1\forms\category\CreateCategoryForm;

class CategoryController extends ApiAuthController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'data' => Category::find()->active()->forUsersInSameGroup($this->_user)->all()
        ];
    }

    public function actionCreate()
    {
        $form = new CreateCategoryForm();
        $form->setUser($this->_user);
        $form->load(Yii::$app->request->post());

        if ($form->save()) {
            return [
                'status' => true,
                'data' => $form->getCategory()
            ];
        }

        return [
            'status' => true,
            'data' => $form->errors
        ];
    }
}