<?php

namespace app\modules\admin\models;


use app\models\tables\Images;
use yii\helpers\BaseFileHelper;

class Image extends Images
{
    public function delete() {
        BaseFileHelper::unlink(\Yii::getAlias('@webroot/img/') . $this->name);
        BaseFileHelper::unlink(\Yii::getAlias('@webroot/img/small/') . $this->name);
        return parent::delete();
    }
    
}