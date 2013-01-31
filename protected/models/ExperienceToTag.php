<?php

/**
 * This is the model class for table "Experience_to_tag".
 *
 * The followings are the available columns in table 'Experience_to_tag':
 * @property integer $Experience_to_tag_ID
 * @property integer $Experience_ID
 * @property integer $Tag_ID
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Experience $experience
 * @property Tag $tag
 */
class ExperienceToTag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExperienceToTag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Experience_to_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Experience_ID, Tag_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Experience_to_tag_ID, Experience_ID, Tag_ID, Created', 'safe'),
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
			'experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
			'tag' => array(self::BELONGS_TO, 'Tag', 'Tag_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Experience_to_tag_ID' => 'Experience To Tag',
			'Experience_ID' => 'Experience',
			'Tag_ID' => 'Tag',
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

		$criteria=new CDbCriteria;

		$criteria->compare('Experience_to_tag_ID',$this->Experience_to_tag_ID);
		$criteria->compare('Experience_ID',$this->Experience_ID);
		$criteria->compare('Tag_ID',$this->Tag_ID);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
