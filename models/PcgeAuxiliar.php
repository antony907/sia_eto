<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_auxiliar".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $pcge_subdivisoria_id
 *
 * @property PcgeSubdivisoria $pcgeSubdivisoria
 */
class PcgeAuxiliar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_auxiliar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['pcge_subdivisoria_id'], 'integer'],
            [['codigo'], 'string', 'max' => 7],
            [['codigo'], 'string', 'min' => 7],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion','filter','filter'=>'strtoupper'],
            ['codigo','poner_id'],
            [['pcge_subdivisoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeSubdivisoria::className(), 'targetAttribute' => ['pcge_subdivisoria_id' => 'id']],
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
            'pcge_subdivisoria_id' => 'Pcge Subdivisoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeSubdivisoria()
    {
        return $this->hasOne(PcgeSubdivisoria::className(), ['id' => 'pcge_subdivisoria_id']);
    }
    
    public function poner_id($attribute, $params)
    {
        $codigo = substr($this->codigo, 0, 5);
        $subdivisoria = PcgeSubdivisoria::find()->where('codigo = "'.$codigo.'"')->one();
        if(empty($subdivisoria))
        {
            $this->addError($attribute,'No existe la sub cuenta '.$codigo.' para crear dicha divisoria');
            return  true;
        }
        else
        {
            $this->pcge_subdivisoria_id = $subdivisoria->id;
        }
        
    }
}
