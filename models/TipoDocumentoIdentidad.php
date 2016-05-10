<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documento_identidad".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property string $abreviatura
 * @property integer $longitud
 * @property string $tipo_dato
 * @property integer $es_empresa
 *
 * @property Empresa[] $empresas
 * @property Persona[] $personas
 */
class TipoDocumentoIdentidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_documento_identidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'abreviatura', 'longitud', 'tipo_dato'], 'required'],
            [['longitud', 'es_empresa'], 'integer'],
            [['codigo'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 100],
            [['abreviatura'], 'string', 'max' => 20],
            [['tipo_dato'], 'string', 'max' => 1]
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
            'nombre' => 'Nombre',
            'abreviatura' => 'Abreviatura',
            'longitud' => 'Longitud',
            'tipo_dato' => 'Tipo Dato',
            'es_empresa' => 'Es Empresa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['id_tipo_doc_iden' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['id_tip_doc_iden' => 'id']);
    }
}
