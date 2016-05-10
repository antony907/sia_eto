<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_subcuenta".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $pcge_cuenta_id
 *
 * @property PcgeDivisoria[] $pcgeDivisorias
 * @property PcgeCuenta $pcgeCuenta
 */
class PcgeSubcuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_subcuenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['pcge_cuenta_id'], 'integer'],
            [['codigo'], 'string', 'max' => 3, 'message'=>'Deben ser 3'],
            [['codigo'], 'string', 'min' => 3, 'message'=>'Deben ser 3'],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion','filter','filter'=>'strtoupper'],
            ['codigo','poner_id'],
            [['pcge_cuenta_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeCuenta::className(), 'targetAttribute' => ['pcge_cuenta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Cod Sub Cuenta',
            'descripcion' => 'Descripcion',
            'pcge_cuenta_id' => 'Pcge Cuenta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeDivisorias()
    {
        return $this->hasMany(PcgeDivisoria::className(), ['pcge_subcuenta_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeCuenta()
    {
        return $this->hasOne(PcgeCuenta::className(), ['id' => 'pcge_cuenta_id']);
    }
    
    public function poner_id($attribute, $params)
    {
        $codigo = substr($this->codigo, 0, 2);
        $cuenta = PcgeCuenta::find()->where('codigo = "'.$codigo.'"')->one();
        if(empty($cuenta))
        {
            $this->addError($attribute,'No existe ninguna cuenta');
            return  true;
        }
        else
        {
            $this->pcge_cuenta_id = $cuenta->id;
        }
        
    }
}
