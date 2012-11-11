<?php

/**
 * This is the model class for table "Class_updates".
 *
 * The followings are the available columns in table 'Class_updates':
 * @property integer $Class_updates_ID
 * @property integer $Class_ID
 * @property integer $User_ID
 * @property string $Message
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property KClass $class
 * @property User $user
 */
class ClassUpdates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassUpdates the static model class
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
		return 'Class_updates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Class_ID, User_ID, Message, Created', 'required'),
			array('Class_ID, User_ID', 'numerical', 'integerOnly'=>true),
			array('Message', 'length', 'max'=>4000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Class_updates_ID, Class_ID, User_ID, Message, Created', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Class_updates_ID' => 'Class Updates',
			'Class_ID' => 'Class',
			'User_ID' => 'User',
			'Message' => 'Message',
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

		$criteria->compare('Class_updates_ID',$this->Class_updates_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Message',$this->Message,true);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}