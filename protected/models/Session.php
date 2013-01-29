<?php

/**
 * This is the model class for table "Session".
 *
 * The followings are the available columns in table 'Session':
 * @property integer $Session_ID
 * @property integer $Experience_ID
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Lesson[] $lessons
 * @property Experience $experience
 * @property UserToSession[] $userToSessions
 */
class Session extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Session the static model class
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
		return 'Session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Experience_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Session_ID, Experience_ID, Created', 'safe'),
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
			'lessons' => array(self::HAS_MANY, 'Lesson', 'Session_ID'),
			'experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
			'userToSessions' => array(self::HAS_MANY, 'UserToSession', 'Session_ID'),
            'students' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'), 'through' => 'userToSessions')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Session_ID' => 'Session',
			'Experience_ID' => 'Class',
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

		$criteria->compare('Session_ID',$this->Session_ID);
		$criteria->compare('Experience_ID',$this->Experience_ID);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}