<?php

/**
 * This is the model class for table "Session_to_location".
 *
 * The followings are the available columns in table 'Session_to_location':
 * @property integer $Session_to_location_ID
 * @property integer $Location_ID
 * @property integer $Session_ID
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Location $location
 * @property Session $session
 */
class SessionToLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SessionToLocation the static model class
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
		return 'Session_to_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Location_ID, Session_ID, Created, Updated', 'required'),
			array('Location_ID, Session_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Session_to_location_ID, Location_ID, Session_ID, Created, Updated', 'safe', 'on'=>'search'),
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
			'location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
			'session' => array(self::BELONGS_TO, 'Session', 'Session_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Session_to_location_ID' => 'Session To Location',
			'Location_ID' => 'Location',
			'Session_ID' => 'Session',
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

		$criteria->compare('Session_to_location_ID',$this->Session_to_location_ID);
		$criteria->compare('Location_ID',$this->Location_ID);
		$criteria->compare('Session_ID',$this->Session_ID);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}