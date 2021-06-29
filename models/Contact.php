<?php

namespace app\models;

use Yii;
use yii\db\QueryInterface;

/**
 * This is the model class for table "contatticonpreferiti".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $telefono
 * @property string|null $indirizzo
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contatticonpreferiti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'telefono'], 'required'],
            [['nome', 'cognome'], 'string', 'max' => 30],
            [['telefono'], 'string', 'max' => 15],
            [['indirizzo'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'telefono' => 'Telefono',
            'indirizzo' => 'Indirizzo',
            'preferito' => 'Preferito',
        ];
    }
    
    
    /*public function find() {
        ;
    }*/
}
