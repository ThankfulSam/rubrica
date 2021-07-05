<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "new_user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $authKey
 * @property string|null $accessToken
 *
 * @property Contatticonpreferiti[] $contatticonpreferitis
 */
class NewUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'new_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string', 'max' => 255],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    

    /**
     * Gets query for [[Contatticonpreferitis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContatticonpreferiti()
    {
        return $this->hasMany(Contact::className(), ['user_id' => 'id']);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken'=>$token]);
    }
    
    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }
    
    public function validatePassword($password) {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
