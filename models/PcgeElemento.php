<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_elemento".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 *
 * @property PcgeCuenta[] $pcgeCuentas
 */
class PcgeElemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_elemento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['codigo'], 'string', 'max' => 1],
            [['codigo'], 'unique'],
            [['codigo'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
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
    public function getPcgeCuentas()
    {
        return $this->hasMany(PcgeCuenta::className(), ['pcge_elemento_id' => 'id']);
    }
}
