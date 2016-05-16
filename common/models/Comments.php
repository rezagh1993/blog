<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $name
 * @property string $content
 * @property integer $active
 * @property string $create_time
 *
 * @property Posts $post
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'name', 'content',], 'required'],
            ['create_time','default' , 'value'=>time() ],
            ['active','default' , 'value'=>0 ],

            [['post_id', 'active'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_title' => 'عنوان پست',
            'name' => 'نویسنده کامنت',
            'content' => 'محتوای کامنت',
            'active' => 'وضعیت',
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }
}
