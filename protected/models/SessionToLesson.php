<?php

/**
 * This is the model class for table "Session_to_lesson".
 *
 * The followings are the available columns in table 'Session_to_lesson':
 * @property integer $Session_to_lesson_ID
 * @property integer $Session_ID
 * @property integer $Lesson_ID
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Session $session
 * @property Lesson $lesson
 */
class SessionToLesson extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SessionToLesson the static model class
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
		return 'Session_to_lesson';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Session_ID, Lesson_ID, Created', 'required'),
			array('Session_ID, Lesson_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Session_to_lesson_ID, Session_ID, Lesson_ID, Created', 'safe', 'on'=>'search'),
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
			'session' => array(self::BELONGS_TO, 'Session', 'Session_ID'),
			'lesson' => array(self::BELONGS_TO, 'Lesson', 'Lesson_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Session_to_lesson_ID' => 'Session To Lesson',
			'Session_ID' => 'Session',
			'Lesson_ID' => 'Lesson',
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

		$criteria->compare('Session_to_lesson_ID',$this->Session_to_lesson_ID);
		$criteria->compare('Session_ID',$this->Session_ID);
		$criteria->compare('Lesson_ID',$this->Lesson_ID);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}