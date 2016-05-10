<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zona".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property string $abreviatura
 * @property integer $empresa_id
 *
 * @property Empresa $empresa
 */
class Zona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'abreviatura', 'empresa_id'], 'required'],
            [['empresa_id'], 'integer'],
            [['codigo'], 'string', 'max' => 6],
            [['nombre'], 'string', 'max' => 50],
            [['abreviatura'], 'string', 'max' => 15],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
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
            'nombre' => 'Nombre',
            'abreviatura' => 'Abreviatura',
            'empresa_id' => 'Empresa ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
    }
}
