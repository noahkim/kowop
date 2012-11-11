<?php

/**
 * This is the model class for table "User_to_class".
 *
 * The followings are the available columns in table 'User_to_class':
 * @property integer $User_to_class_ID
 * @property integer $User_ID
 * @property integer $Class_ID
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property KClass $class
 */
class UserToClass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserToClass the static model class
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
		return 'User_to_class';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_ID, Class_ID, Created', 'required'),
			array('User_ID, Class_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('User_to_class_ID, User_ID, Class_ID, Created', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
			'class' => array(self::BELONGS_TO, 'KClass', 'Class_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'User_to_class_ID' => 'User To Class',
			'User_ID' => 'User',
			'Class_ID' => 'Class',
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

		$criteria->compare('User_to_class_ID',$this->User_to_class_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}