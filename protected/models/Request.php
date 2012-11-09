<?php

/**
 * This is the model class for table "Request".
 *
 * The followings are the available columns in table 'Request':
 * @property integer $Request_ID
 * @property integer $Create_User_ID
 * @property integer $Type
 * @property string $Name
 * @property string $Description
 * @property string $Cost
 * @property integer $MinimumRating
 * @property integer $Created_Class_ID
 * @property integer $Location_ID
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property KClass $createdClass
 * @property Location $location
 * @property RequestToCategory[] $requestToCategories
 * @property RequestToUser[] $requestToUsers
 */
class Request extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Request the static model class
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
		return 'Request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Type, Name', 'required'),
			array('Type, MinimumRating', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>255),
			array('Description', 'length', 'max'=>2000),
			array('Cost', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Request_ID, Create_User_ID, Type, Name, Description, Cost, MinimumRating, Created_Class_ID, Location_ID, Created, Updated', 'safe', 'on'=>'search'),
            array('Updated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('Created,Updated', 'default',
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
			'createUser' => array(self::BELONGS_TO, 'User', 'Create_User_ID'),
			'createdClass' => array(self::BELONGS_TO, 'KClass', 'Created_Class_ID'),
			'location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
			'requestToCategories' => array(self::HAS_MANY, 'RequestToCategory', 'Request_ID'),
			'requestToUsers' => array(self::HAS_MANY, 'RequestToUser', 'Request_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Request_ID' => 'Request',
			'Create_User_ID' => 'Create User',
			'Type' => 'Type',
			'Name' => 'Name',
			'Description' => 'Description',
			'Cost' => 'Cost',
			'MinimumRating' => 'Minimum Rating',
			'Created_Class_ID' => 'Created Class',
			'Location_ID' => 'Location',
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

		$criteria->compare('Request_ID',$this->Request_ID);
		$criteria->compare('Create_User_ID',$this->Create_User_ID);
		$criteria->compare('Type',$this->Type);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Cost',$this->Cost,true);
		$criteria->compare('MinimumRating',$this->MinimumRating);
		$criteria->compare('Created_Class_ID',$this->Created_Class_ID);
		$criteria->compare('Location_ID',$this->Location_ID);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave()
    {
        $this->Create_User_ID = Yii::app()->user->id;

        return parent::beforeSave();
    }
}