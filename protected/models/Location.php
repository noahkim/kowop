<?php

/**
 * This is the model class for table "Location".
 *
 * The followings are the available columns in table 'Location':
 * @property integer $Location_ID
 * @property string $Name
 * @property string $Address
 * @property string $City
 * @property string $State
 * @property string $Zip
 * @property string $Country
 * @property integer $Type
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property KClass[] $kClasses
 * @property Request[] $requests
 */
class Location extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Location the static model class
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
		return 'Location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Address, City, State, Zip, Type', 'required'),
			array('Type', 'numerical', 'integerOnly'=>true),
			array('Address', 'length', 'max'=>2000),
			array('Name, City, Country', 'length', 'max'=>255),
			array('State', 'length', 'max'=>2),
			array('Zip', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Location_ID, Name, Address, City, State, Zip, Country, Type, Created, Updated', 'safe', 'on'=>'search'),
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
			'kClasses' => array(self::HAS_MANY, 'KClass', 'Location_ID'),
			'requests' => array(self::HAS_MANY, 'Request', 'Location_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Location_ID' => 'Location',
            'Name' => 'Name',
			'Address' => 'Address',
			'City' => 'City',
			'State' => 'State',
			'Zip' => 'Zip',
			'Country' => 'Country',
			'Type' => 'Type',
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

		$criteria->compare('Location_ID',$this->Location_ID);
        $criteria->compare('Name',$this->Name,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('State',$this->State,true);
		$criteria->compare('Zip',$this->Zip,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('Type',$this->Type);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function findExisting($location)
    {
        $criteria = array('Address' => $location->Address,
            'City' => $location->City,
            'State' => $location->State,
            'Zip' => $location->Zip,
            'Country' => $location->Country);

        $result = Location::model()->findByAttributes($criteria);
        return $result;
    }
}