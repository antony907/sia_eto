<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_civil".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Persona[] $personas
 */
class EstadoCivil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_civil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['codigo'], 'string', 'max' => 2],
            [['descripcion'], 'string', 'max' => 20]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_est_civil' => 'id']);
    }
}
