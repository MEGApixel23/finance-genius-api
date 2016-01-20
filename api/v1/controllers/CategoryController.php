<?php

namespace api\v1\controllers;

use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\models\Category;
use api\v1\models\queries\CategoryActiveQuery;

class CategoryController extends ApiAuthController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'result' => CategoryActiveQuery::findActive()->where([
                'user_id' => $this->_user->id
            ])->all()
        ];
    }

    public function actionCreate()
    {
        $category = new Category();
        $category->load(Yii::$app->request->post());
        $category->setUser($this->_user);

        if ($category->validate() && $category->save()) {
            return [
                'status' => true,
                'result' => $category
            ];
        }

        return [
            'status' => true,
            'errors' => $category->errors
        ];
    }
}