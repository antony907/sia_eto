<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property string $abreviatura
 */
class TipoDocumento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion', 'abreviatura'], 'required'],
            [['codigo'], 'string', 'max' => 2],
            [['codigo'], 'string', 'min' => 2],
            [['codigo'], 'unique'],
            [['codigo','descripcion','abreviatura'],'filter','filter'=>'strtoupper'],
            [['descripcion'], 'string', 'max' => 200],
            [['abreviatura'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'abreviatura' => 'Abreviatura',
        ];
    }
    
    
}
