<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property integer $active
 * @property string $urlkey
 *
 * @property PostCategory[] $postCategories
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'active', 'type'], 'required'],
            [['active','type'], 'integer'],
            ['type','default','value'=>0 ],
            ['active','default','value'=>0 ],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => 'عنوان',
            'active' => 'وضعیت',
            'type' => 'نوع دسته بندی',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategories()
    {
        return $this->hasMany(PostCategory::className(), ['category_id' => 'id']);
    }
    public function getPosts()
    {
        return $this->hasMany(Posts::className(),['id'=>'post_id'])->viaTable('post_category',['category_id'=>'id']);
    }

}
