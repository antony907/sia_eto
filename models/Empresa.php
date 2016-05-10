<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $id
 * @property string $razon_social
 * @property string $ruc
 * @property string $rubro
 * @property string $telefono
 * @property string $direccion
 * @property string $ciudad
 * @property string $email
 * @property string $regimen
 * @property string $anio_ini_contable
 * @property integer $por_renta
 * @property integer $por_participa_trab
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['razon_social', 'ruc', 'rubro', 'telefono', 'direccion', 'ciudad', 'email', 'regimen', 'anio_ini_contable', 'por_renta', 'por_participa_trab'], 'required'],
            [['por_renta', 'por_participa_trab'], 'integer'],
            [['razon_social', 'rubro', 'direccion'], 'string', 'max' => 100],
            [['ruc'], 'string', 'max' => 11],
            [['telefono'], 'string', 'max' => 12],
            [['ciudad'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 30],
            [['regimen'], 'string', 'max' => 20],
            [['anio_ini_contable'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'razon_social' => 'Razon Social',
            'ruc' => 'Ruc',
            'rubro' => 'Rubro',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'email' => 'Email',
            'regimen' => 'Regimen',
            'anio_ini_contable' => 'Anio Ini Contable',
            'por_renta' => 'Por Renta',
            'por_participa_trab' => 'Por Participa Trab',
        ];
    }
}
