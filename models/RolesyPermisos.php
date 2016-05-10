<?php
namespace app\models;

use Yii;

class RolesyPermisos extends \yii\db\ActiveRecord
{
    public $nombre;
    public $descripcion;
    public $tipo;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre','descripcion'], 'required'],
            ['nombre', 'nombre_existe'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
        ];
    }
    
    public function nombre_existe($attribute, $params)
    {
        $nombre = AuthItem::find()->where('name = "'.$this->nombre.'"')->one();
        
        if(!empty($nombre))
        {
            $this->addError($attribute, 'El nombre ya existe');
            return true;
        }
        else
        {
            return false;
        }
    }

}
