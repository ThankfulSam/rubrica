<?php

namespace app\models;

use Yii;

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
class NewUser extends \yii\db\ActiveRecord
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
    public function getContatticonpreferitis()
    {
        return $this->hasMany(Contact::className(), ['user_id' => 'id']);
    }
}
