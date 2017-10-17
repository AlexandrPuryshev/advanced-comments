<?php 

namespace common\models\forms;

use yii\helpers\Url;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadFormMobile extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public $names = array();

    public function rules()
    {
        return [
            // Максимальный и минимальный размер указываем в байтах.
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg', 'maxFiles' => 6],
        ];
    }
    
    public function upload($object)
    {
        if(!empty($this->imageFiles)){
            if ($this->validate()) {
                foreach ($this->imageFiles as $file) {
                    $name =  "image-prefix-" . time() . '-' . urlencode($file->baseName);
                    array_push($this->names, Url::to(Yii::getAlias('@imageUrlPathChat') . '/' . $name));
                    if ($object == "post") {
                        $file->saveAs(Yii::getAlias('@imageUrlPathPost') . '\\' . $name . '.' . $file->extension);
                    } else if ($object == "message") {
                        $file->saveAs(Yii::getAlias('@imageUrlPathChat') . '\\' . $name . '.' . $file->extension);
                    }
                }
                return true;
            }
        }
        return false;
    }
}

?>