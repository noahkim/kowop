<?php

/**
 * This is the model class for table "Class_to_tag".
 *
 * The followings are the available columns in table 'Class_to_tag':
 * @property integer $Class_to_tag_ID
 * @property integer $Class_ID
 * @property integer $Tag_ID
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property KClass $class
 * @property Tag $tag
 */
class ClassToTag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassToTag the static model class
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
		return 'Class_to_tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Class_to_tag_ID, Class_ID, Tag_ID, Created', 'safe', 'on'=>'search'),
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
			'class' => array(self::BELONGS_TO, 'KClass', 'Class_ID'),
			'tag' => array(self::BELONGS_TO, 'Tag', 'Tag_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Class_to_tag_ID' => 'Class To Tag',
			'Class_ID' => 'Class',
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

		$criteria->compare('Class_to_tag_ID',$this->Class_to_tag_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('Tag_ID',$this->Tag_ID);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}