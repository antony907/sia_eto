<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asiento_contable".
 *
 * @property integer $id
 * @property integer $anio
 * @property integer $mes
 * @property string $fecha
 * @property string $glosa
 * @property integer $num_asiento
 *
 * @property AsientoDetalle[] $asientoDetalles
 */
class AsientoContable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asiento_contable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anio', 'mes', 'num_asiento'], 'integer'],
            [['fecha'], 'safe'],
            [['glosa'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anio' => 'Anio',
            'mes' => 'Mes',
            'fecha' => 'Fecha',
            'glosa' => 'Glosa',
            'num_asiento' => 'Num Asiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientoDetalles()
    {
        return $this->hasMany(AsientoDetalle::className(), ['asiento_contable_id' => 'id']);
    }
}
