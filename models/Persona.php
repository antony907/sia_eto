<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $id
 * @property integer $id_tip_doc_iden
 * @property string $num_doc
 * @property string $razon_social
 * @property string $direccion
 * @property integer $id_genero
 * @property integer $id_est_civil
 * @property string $nombres
 * @property string $paterno
 * @property string $materno
 * @property string $fecha_nac
 * @property string $telefono
 * @property string $celular
 * @property string $correo
 * @property string $fecha_inscripcion
 * @property string $tipo_contrib
 * @property string $estado_contrib
 * @property string $condicion_contrib
 *
 * @property Empresa[] $empresas
 * @property EstadoCivil $idEstCivil
 * @property Genero $idGenero
 * @property TipoDocumentoIdentidad $idTipDocIden
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tip_doc_iden', 'num_doc', 'razon_social', 'direccion'], 'required'],
            [['id_tip_doc_iden', 'id_genero', 'id_est_civil'], 'integer'],
            [['fecha_nac', 'fecha_inscripcion'], 'safe'],
            [['fecha_nac'], 'date', 'format'=>'php:Y-m-d'],
            [['num_doc'], 'string', 'max' => 15],
            [['razon_social'], 'string', 'max' => 200],
            [['direccion'], 'string', 'max' => 300],
            [['nombres', 'paterno', 'materno', 'tipo_contrib'], 'string', 'max' => 100],
            [['telefono', 'celular'], 'string', 'max' => 12],
            [['correo'], 'string', 'max' => 50],
            [['correo'],'email'],
            [['estado_contrib', 'condicion_contrib'], 'string', 'max' => 30],
            [['id_tip_doc_iden', 'num_doc'], 'unique', 'targetAttribute' => ['id_tip_doc_iden', 'num_doc'], 'message' => 'The combination of Id Tip Doc Iden and Num Doc has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tip_doc_iden' => 'Id Tip Doc Iden',
            'num_doc' => 'Num Doc',
            'razon_social' => 'Razon Social',
            'direccion' => 'Direccion',
            'id_genero' => 'Id Genero',
            'id_est_civil' => 'Id Est Civil',
            'nombres' => 'Nombres',
            'paterno' => 'Paterno',
            'materno' => 'Materno',
            'fecha_nac' => 'Fecha Nac',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'correo' => 'Correo',
            'fecha_inscripcion' => 'Fecha Inscripcion',
            'tipo_contrib' => 'Tipo Contrib',
            'estado_contrib' => 'Estado Contrib',
            'condicion_contrib' => 'Condicion Contrib',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['id_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstCivil()
    {
        return $this->hasOne(EstadoCivil::className(), ['id' => 'id_est_civil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGenero()
    {
        return $this->hasOne(Genero::className(), ['id' => 'id_genero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipDocIden()
    {
        return $this->hasOne(TipoDocumentoIdentidad::className(), ['id' => 'id_tip_doc_iden']);
    }
}
