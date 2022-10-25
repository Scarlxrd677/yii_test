<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegForm extends Model
{
    public $username;
    public $password;
    public $repeat_password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'password', 'repeat_password'], 'required'],
            ['password', 'compare', 'compareAttribute' => 'repeat_password'],

            // email has to be a valid email address\
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
        ];
    }

    public function reg(){
        $user = new User();
        $user->username = $this->username;
        $user->password = $this->password;
        return $user->save();
    }
}
