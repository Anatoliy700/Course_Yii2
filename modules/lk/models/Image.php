<?php

namespace app\modules\lk\models;


use app\models\tables\Images;
use yii\data\ActiveDataProvider;
use \yii\helpers\Inflector;
use \dosamigos\transliterator\TransliteratorHelper;

class Image extends Images
{
    /* @var \yii\web\UploadedFile*/
    public $image;
    
    public function rules() {
       return [
           [['image'], 'required'],
           [['image'], 'file', 'extensions' => 'jpg, png']
       ];
    }
    
    public function upload($id){
        if ($this->validate()){
            $this->name = $this->translit($this->image->getBaseName()) . '.' . $this->image->getExtension();
            $this->task_id = $id;
            $fileName = '@taskImageRoot/' . $this->name;
            $this->image->saveAs(\Yii::getAlias($fileName));
           \yii\imagine\Image::thumbnail($fileName, '200', null)
                ->save(\Yii::getAlias('@taskImageRoot/small/' . $this->name));
           $model = new Images();
           $model->setAttributes($this->attributes);
           $model->save();
           return true;
        }
        return false;
    }
    
    static public function getDataProvider($id){
        return new ActiveDataProvider([
            'query' => Images::find()->where(['task_id' => $id])
        ]);
    }
    
    public function translit($str){
        return Inflector::slug(TransliteratorHelper::process($str), '-', true);
    }
    
}