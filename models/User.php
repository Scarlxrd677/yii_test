<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = self::findOne(['id' => $id]);
        return $user ? $user : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = self::findOne(['username' => $username]);
        return $user ? $user : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }


    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $count = self::find()->count();
            if($count == 0) {
                $this->role = 'admin';
            } else {
                $this->role = 'user';
            }
            return true;
        }
    }

    public function rules(){
        return [
            ['username', 'required'],
            ['username', 'unique'],
            ['password', 'safe'],
            ['role', 'safe']
        ];
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

}
