<?php

Yii::import('ext.iwi.Iwi');

/**
 * This is the model class for table "Content".
 *
 * The followings are the available columns in table 'Content':
 * @property integer $Content_ID
 * @property integer $Content_type
 * @property string $Content_name
 * @property string $Link
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property ClassToContent[] $classToContents
 * @property CourseToContent[] $courseToContents
 * @property UserToContent[] $userToContents
 */
class Content extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Content';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Content_type, Content_name', 'required'),
            array('Content_type', 'numerical', 'integerOnly' => true),
            array('Content_name, Link', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Content_ID, Content_type, Content_name, Link, Created, Updated', 'safe'),
            array('Updated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('Created,Updated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'classToContents' => array(self::HAS_MANY, 'ClassToContent', 'Content_ID'),
            'courseToContents' => array(self::HAS_MANY, 'CourseToContent', 'Content_ID'),
            'userToContents' => array(self::HAS_MANY, 'UserToContent', 'Content_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Content_ID' => 'Content',
            'Content_type' => 'Content Type',
            'Content_name' => 'Content Name',
            'Link' => 'Link',
            'Created' => 'Created',
            'Updated' => 'Updated',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Content_ID', $this->Content_ID);
        $criteria->compare('Content_type', $this->Content_type);
        $criteria->compare('Content_name', $this->Content_name, true);
        $criteria->compare('Link', $this->Link, true);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function AddContent($imageFile, $name, $type, $targetRatio = null)
    {
        if ($targetRatio == null)
        {
            $targetRatio = 4 / 3;
        }

        if (is_string($imageFile))
        {
            $pathParts = pathinfo($imageFile);
            $originalExtension = strtolower($pathParts['extension']);

            $imageFileName = $imageFile;
        }
        else
        {
            $pathParts = pathinfo($imageFile->getName());
            $originalExtension = strtolower($pathParts['extension']);

            $imageFileName = 'temp' . uniqid() . '.' . $originalExtension;
            $imageFile->saveAs(Yii::app()->params['temp'] . '/' . $imageFileName);
        }

        $content = new Content;
        $content->Content_name = $name;
        $content->Content_type = $type;

        $content->save();
        $content->refresh();

        $path = Yii::app()->params['uploads'] . '/' . $content->Content_ID;
        $link = Yii::app()->params['siteBase'] . '/uploads/' . $content->Content_ID;

        $path .= '.' . $originalExtension;
        $link .= '.' . $originalExtension;

        rename(Yii::app()->params['temp'] . '/' . $imageFileName, $path);

        $image = new Iwi($path);

        $sourceRatio = $image->width / $image->height;

        if ($sourceRatio > $targetRatio)
        {
            $height = $image->height;
            $width = (int)$height * $targetRatio;
        }
        elseif ($sourceRatio < $targetRatio)
        {
            $width = $image->width;
            $height = (int)$width / $targetRatio;
        }

        $image->adaptive($width, $height);
        $image->save();

        $content->Link = $link;
        $content->save();

        return $content;
    }
}