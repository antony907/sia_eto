<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_divisoria".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $pcge_subcuenta_id
 *
 * @property PcgeSubcuenta $pcgeSubcuenta
 * @property PcgeSubdivisoria[] $pcgeSubdivisorias
 */
class PcgeDivisoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_divisoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['pcge_subcuenta_id'], 'integer'],
            [['codigo'], 'string', 'max' => 4],
            [['codigo'], 'string', 'min' => 4],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion','filter','filter'=>'strtoupper'],
            ['codigo','poner_id'],
            [['pcge_subcuenta_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeSubcuenta::className(), 'targetAttribute' => ['pcge_subcuenta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Cod Divisoria',
            'descripcion' => 'Descripcion',
            'pcge_subcuenta_id' => 'Pcge Subcuenta ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeSubcuenta()
    {
        return $this->hasOne(PcgeSubcuenta::className(), ['id' => 'pcge_subcuenta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeSubdivisorias()
    {
        return $this->hasMany(PcgeSubdivisoria::className(), ['pcge_divisoria_id' => 'id']);
    }
    
    public function poner_id($attribute, $params)
    {
        $codigo = substr($this->codigo, 0, 3);
        $subcuenta = PcgeSubcuenta::find()->where('codigo = "'.$codigo.'"')->one();
        if(empty($subcuenta))
        {
            $this->addError($attribute,'No existe la sub cuenta '.$codigo.' para crear dicha divisoria');
            return  true;
        }
        else
        {
            $this->pcge_subcuenta_id = $subcuenta->id;
        }
        
    }
}
