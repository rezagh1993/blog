<?php
namespace frontend\models;

use common\models\User;
use common\models\Users;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $username;
    public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username', 'password'], 'required'],
            [['password'], 'string', 'min' => 6, 'max' => 255],
            [['name','username'], 'string', 'min' => 3, 'max' => 255],
            [['username'], 'unique', 'targetClass' => '\common\models\Users', 'message' => 'این نام کاربری قبلا انتخاب شده است'],


           /* ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'این ایمیل قبلا انتخاب شده است'],
*/

        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'نام',
            'username' => 'نام کاربری',
            'password' => 'کلمه عبور',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Users();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
        
    }
}
