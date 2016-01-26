<?php

namespace api\v1\forms\category;

use api\v1\forms\ApiForm;
use api\v1\models\Category;
use api\v1\models\User;

class CreateCategoryForm extends ApiForm
{
    public $name;
    public $type;
    public $category_id;

    protected $_category;

    public function rules()
    {
        return [
            ['name', 'required'],
            ['type', 'in', 'range' => [Category::TYPE_INCOME, Category::TYPE_OUTCOME, Category::TYPE_COMMON]],
            ['category_id', 'integer'],
            ['category_id', 'categoryValidator'],
        ];
    }

    public function categoryValidator($attr)
    {
        if (!$this->hasErrors($attr)) {
            $category = Category::find()
                ->active()
                ->forUsersInSameGroup($this->_user)
                ->andWhere(['id' => $this->$attr])
                ->all();

            if (!$category) {
                $this->addError($attr, 'There is no such parent category');
                return false;
            }

            return true;
        }
    }

    public function save()
    {
        if (!$this->validate())
            return false;

        $category = new Category();
        $category->type = $this->type;
        $category->category_id = $this->category_id ?: null;
        $category->name = $this->name;
        $category->user_id = $this->_user->id;

        if ($category->save()) {
            $this->_category = $category;
            return true;
        }

        return false;
    }

    public function getCategory()
    {
        return $this->_category;
    }
}