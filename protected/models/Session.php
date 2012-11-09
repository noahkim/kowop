<?php

/**
 * This is the model class for table "Session".
 *
 * The followings are the available columns in table 'Session':
 * @property integer $Session_ID
 * @property integer $Class_ID
 * @property string $Start
 * @property string $End
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property KClass $class
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
			array('Class_ID, Start, End, Created, Updated', 'required'),
			array('Class_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Session_ID, Class_ID, Start, End, Created, Updated', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Session_ID' => 'Session',
			'Class_ID' => 'Class',
			'Start' => 'Start',
			'End' => 'End',
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

		$criteria->compare('Session_ID',$this->Session_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('Start',$this->Start,true);
		$criteria->compare('End',$this->End,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}