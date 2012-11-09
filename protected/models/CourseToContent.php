<?php

/**
 * This is the model class for table "Course_to_content".
 *
 * The followings are the available columns in table 'Course_to_content':
 * @property integer $Course_to_content_ID
 * @property integer $Content_ID
 * @property integer $Course_ID
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Content $content
 * @property Course $course
 */
class CourseToContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseToContent the static model class
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
		return 'Course_to_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Content_ID, Course_ID, Updated', 'required'),
			array('Content_ID, Course_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Course_to_content_ID, Content_ID, Course_ID, Updated', 'safe', 'on'=>'search'),
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
			'content' => array(self::BELONGS_TO, 'Content', 'Content_ID'),
			'course' => array(self::BELONGS_TO, 'Course', 'Course_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Course_to_content_ID' => 'Course To Content',
			'Content_ID' => 'Content',
			'Course_ID' => 'Course',
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

		$criteria->compare('Course_to_content_ID',$this->Course_to_content_ID);
		$criteria->compare('Content_ID',$this->Content_ID);
		$criteria->compare('Course_ID',$this->Course_ID);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}