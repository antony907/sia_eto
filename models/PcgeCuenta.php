<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_cuenta".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $pcge_elemento_id
 *
 * @property PcgeElemento $pcgeElemento
 * @property PcgeSubcuenta[] $pcgeSubcuentas
 */
class PcgeCuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_cuenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['pcge_elemento_id'], 'integer'],
            [['codigo'], 'string', 'max' => 2],
            [['codigo'], 'string', 'min' => 2],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion','filter','filter'=>'strtoupper'],
            ['codigo','poner_id'],
            [['pcge_elemento_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeElemento::className(), 'targetAttribute' => ['pcge_elemento_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Cod Cuenta',
            'descripcion' => 'Descripcion',
            'pcge_elemento_id' => 'Pcge Elemento ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeElemento()
    {
        return $this->hasOne(PcgeElemento::className(), ['id' => 'pcge_elemento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeSubcuentas()
    {
        return $this->hasMany(PcgeSubcuenta::className(), ['pcge_cuenta_id' => 'id']);
    }
    
    public function poner_id()
    {
        $codigo = substr($this->codigo, 0, 1);
        $elemento = PcgeElemento::find()->where('codigo = "'.$codigo.'"')->one();
        $this->pcge_elemento_id = $elemento->id;
    }
}
