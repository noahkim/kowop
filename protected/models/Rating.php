<?php

/**
 * This is the model class for table "Rating".
 *
 * The followings are the available columns in table 'Rating':
 * @property integer $Rating_ID
 * @property integer $User_ID
 * @property integer $Rate_User_ID
 * @property integer $Class_ID
 * @property string $Comment
 * @property integer $Flagged
 * @property integer $Active
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $rateUser
 * @property KClass $class
 */
class Rating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rating the static model class
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
		return 'Rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_ID, Rate_User_ID, Class_ID, Created', 'required'),
			array('User_ID, Rate_User_ID, Class_ID, Flagged, Active', 'numerical', 'integerOnly'=>true),
			array('Comment', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Rating_ID, User_ID, Rate_User_ID, Class_ID, Comment, Flagged, Active, Created', 'safe', 'on'=>'search'),
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
			'rateUser' => array(self::BELONGS_TO, 'User', 'Rate_User_ID'),
			'class' => array(self::BELONGS_TO, 'KClass', 'Class_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Rating_ID' => 'Rating',
			'User_ID' => 'User',
			'Rate_User_ID' => 'Rate User',
			'Class_ID' => 'Class',
			'Comment' => 'Comment',
			'Flagged' => 'Flagged',
			'Active' => 'Active',
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

		$criteria->compare('Rating_ID',$this->Rating_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Rate_User_ID',$this->Rate_User_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('Comment',$this->Comment,true);
		$criteria->compare('Flagged',$this->Flagged);
		$criteria->compare('Active',$this->Active);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}