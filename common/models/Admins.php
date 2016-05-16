<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $user
 * @property string $pass
 * @property integer $active
 */
class Admins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'user', 'pass', 'active'], 'required'],
            [['active'], 'integer'],
            [['fullname', 'user', 'pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'user' => 'User',
            'pass' => 'Pass',
            'active' => 'Active',
        ];
    }
}
