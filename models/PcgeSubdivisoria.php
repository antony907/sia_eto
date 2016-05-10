<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcge_subdivisoria".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $pcge_divisoria_id
 *
 * @property PcgeAuxiliar[] $pcgeAuxiliars
 * @property PcgeDivisoria $pcgeDivisoria
 */
class PcgeSubdivisoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcge_subdivisoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
            [['pcge_divisoria_id'], 'integer'],
            [['codigo'], 'string', 'max' => 5],
            [['codigo'], 'string', 'min' => 5],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['descripcion'], 'string', 'max' => 100],
            ['descripcion','filter','filter'=>'strtoupper'],
            ['codigo','poner_id'],
            [['pcge_divisoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeDivisoria::className(), 'targetAttribute' => ['pcge_divisoria_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Cod Sub Divisoria',
            'descripcion' => 'Des. Sub Divisoria',
            'pcge_divisoria_id' => 'Pcge Divisoria ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeAuxiliars()
    {
        return $this->hasMany(PcgeAuxiliar::className(), ['pcge_subdivisoria_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeDivisoria()
    {
        return $this->hasOne(PcgeDivisoria::className(), ['id' => 'pcge_divisoria_id']);
    }
    
    public function poner_id($attribute, $params)
    {
        $codigo = substr($this->codigo, 0, 4);
        $divisoria = PcgeDivisoria::find()->where('codigo = "'.$codigo.'"')->one();
        if(empty($divisoria))
        {
            $this->addError($attribute,'No existe la sub cuenta '.$codigo.' para crear dicha divisoria');
            return  true;
        }
        else
        {
            $this->pcge_divisoria_id = $divisoria->id;
        }
        
    }
}
