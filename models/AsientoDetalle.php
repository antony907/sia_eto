<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asiento_detalle".
 *
 * @property integer $id
 * @property string $num_doc
 * @property string $fecha
 * @property string $glosa
 * @property string $debe
 * @property string $haber
 * @property integer $pcge_auxiliar_id
 * @property integer $tipo_documento_id
 * @property integer $persona_id
 * @property integer $asiento_contable_id
 *
 * @property PcgeAuxiliar $pcgeAuxiliar
 * @property Persona $persona
 * @property TipoDocumento $tipoDocumento
 * @property AsientoContable $asientoContable
 */
class AsientoDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asiento_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_doc', 'fecha', 'glosa', 'pcge_auxiliar_id', 'tipo_documento_id', 'persona_id', 'asiento_contable_id'], 'required'],
            [['fecha'], 'safe'],
            [['debe', 'haber'], 'number'],
            [['pcge_auxiliar_id', 'tipo_documento_id', 'persona_id', 'asiento_contable_id'], 'integer'],
            [['num_doc'], 'string', 'max' => 12],
            [['glosa'], 'string', 'max' => 200],
            [['pcge_auxiliar_id'], 'exist', 'skipOnError' => true, 'targetClass' => PcgeAuxiliar::className(), 'targetAttribute' => ['pcge_auxiliar_id' => 'id']],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['tipo_documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['tipo_documento_id' => 'id']],
            [['asiento_contable_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsientoContable::className(), 'targetAttribute' => ['asiento_contable_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num_doc' => 'Num Doc',
            'fecha' => 'Fecha',
            'glosa' => 'Glosa',
            'debe' => 'Debe',
            'haber' => 'Haber',
            'pcge_auxiliar_id' => 'Pcge Auxiliar ID',
            'tipo_documento_id' => 'Tipo Documento ID',
            'persona_id' => 'Persona ID',
            'asiento_contable_id' => 'Asiento Contable ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcgeAuxiliar()
    {
        return $this->hasOne(PcgeAuxiliar::className(), ['id' => 'pcge_auxiliar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['id' => 'persona_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDocumento()
    {
        return $this->hasOne(TipoDocumento::className(), ['id' => 'tipo_documento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientoContable()
    {
        return $this->hasOne(AsientoContable::className(), ['id' => 'asiento_contable_id']);
    }
}
