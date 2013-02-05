<?php

/**
 * This is the model class for table "Tag".
 *
 * The followings are the available columns in table 'Tag':
 * @property integer $Tag_ID
 * @property string $Name
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property ExperienceToTag[] $experienceToTags
 * @property RequestToTag[] $requestToTags
 */
class Tag extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $experienceName active record class name.
     * @return Tag the static model class
     */
    public static function model($experienceName = __CLASS__)
    {
        return parent::model($experienceName);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Tag_ID, Name, Created', 'safe', 'on' => 'search'),
            array('Created', 'default',
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
            'experienceToTags' => array(self::HAS_MANY, 'ExperienceToTag', 'Tag_ID'),
            'requestToTags' => array(self::HAS_MANY, 'RequestToTag', 'Tag_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'Tag_ID' => 'Tag',
            'Name' => 'Name',
            'Created' => 'Created',
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

        $criteria->compare('Tag_ID', $this->Tag_ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Created', $this->Created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function findOrCreate($name)
    {
        $name = strtolower($name);
        $tag = Tag::model()->find('Name=:Name', array(':Name' => $name));

        if ($tag == null)
        {
            $tag = new Tag;
            $tag->Name = $name;
            $tag->save();
        }

        return $tag;
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ', $tags);
    }
}
