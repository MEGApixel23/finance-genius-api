<?php

namespace api\v1\controllers;

use api\v1\models\ApiActiveRecord;
use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\models\Category;
use api\v1\forms\category\CreateCategoryForm;

class CategoryController extends ApiAuthController
{
    public function actionIndex()
    {
        $categories = Category::find()
            ->active()
            ->forUsersInSameGroup($this->_user)
            ->expand(Yii::$app->request->getQueryParams())
            ->asArray()
            ->all();

        return [
            'status' => true,
            'data' => $categories
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
            'error' => ApiActiveRecord::ERROR_VALIDATION,
            'error_code' => ApiActiveRecord::ERROR_VALIDATION,
            'data' => $form->errors
        ];
    }
}