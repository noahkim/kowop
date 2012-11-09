<?php

/**
 * This is the model class for table "Course".
 *
 * The followings are the available columns in table 'Course':
 * @property integer $Course_ID
 * @property string $Name
 * @property string $Description
 * @property string $Prerequisites
 * @property string $Course_materials
 * @property string $Start
 * @property string $End
 * @property string $Cost
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property CourseToContent[] $courseToContents
 * @property KClass[] $kClasses
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
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
		return 'Course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Description, Start, End, Cost, Created, Updated', 'required'),
			array('Name', 'length', 'max'=>255),
			array('Description, Prerequisites, Course_materials', 'length', 'max'=>2000),
			array('Cost', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Course_ID, Name, Description, Prerequisites, Course_materials, Start, End, Cost, Created, Updated', 'safe', 'on'=>'search'),
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
			'courseToContents' => array(self::HAS_MANY, 'CourseToContent', 'Course_ID'),
			'kClasses' => array(self::HAS_MANY, 'KClass', 'Course_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Course_ID' => 'Course',
			'Name' => 'Name',
			'Description' => 'Description',
			'Prerequisites' => 'Prerequisites',
			'Course_materials' => 'Course Materials',
			'Start' => 'Start',
			'End' => 'End',
			'Cost' => 'Cost',
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

		$criteria=new CDbCriteria;

		$criteria->compare('Course_ID',$this->Course_ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Prerequisites',$this->Prerequisites,true);
		$criteria->compare('Course_materials',$this->Course_materials,true);
		$criteria->compare('Start',$this->Start,true);
		$criteria->compare('End',$this->End,true);
		$criteria->compare('Cost',$this->Cost,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}