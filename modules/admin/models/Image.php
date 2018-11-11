<?php

namespace app\modules\admin\models;


use app\models\tables\Images;
use yii\helpers\BaseFileHelper;

class Image extends Images
{
    public function delete() {
        BaseFileHelper::unlink(\Yii::getAlias('@taskImageRoot/') . $this->name);
        BaseFileHelper::unlink(\Yii::getAlias('@taskImageRoot/small/') . $this->name);
        return parent::delete();
    }
    
}