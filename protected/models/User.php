<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $User_ID
 * @property string $First_name
 * @property string $Last_name
 * @property string $Password
 * @property string $Email
 * @property string $Phone_number
 * @property string $Description
 * @property string $Teacher_alias
 * @property integer $IsAdmin
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property ClassUpdates[] $classUpdates
 * @property KClass[] $kClasses
 * @property Rating[] $ratings
 * @property Rating[] $ratings1
 * @property Request[] $requests
 * @property RequestToUser[] $requestToUsers
 * @property UserToClass[] $userToClasses
 * @property UserToContent[] $userToContents
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('First_name, Last_name, Password, Email', 'required'),
			array('First_name, Last_name, Password, Email, Description, Teacher_alias', 'length', 'max'=>255),
			array('Phone_number', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('User_ID, First_name, Last_name, Password, Email, Phone_number, Description, Teacher_alias, IsAdmin, Created, Updated', 'safe', 'on'=>'search'),
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
            'classUpdates' => array(self::HAS_MANY, 'ClassUpdates', 'User_ID'),
            'kClasses' => array(self::HAS_MANY, 'KClass', 'Create_user_ID'),
			'ratings' => array(self::HAS_MANY, 'Rating', 'User_ID'),
			'rated' => array(self::HAS_MANY, 'Rating', 'Rate_User_ID'),
			'requests' => array(self::HAS_MANY, 'Request', 'Create_User_ID'),
			'requestToUsers' => array(self::HAS_MANY, 'RequestToUser', 'User_ID'),
            'userToClasses' => array(self::HAS_MANY, 'UserToClass', 'User_ID'),
			'userToContents' => array(self::HAS_MANY, 'UserToContent', 'User_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'User_ID' => 'User',
			'First_name' => 'First Name',
			'Last_name' => 'Last Name',
			'Password' => 'Password',
			'Email' => 'Email',
			'Phone_number' => 'Phone Number',
			'Description' => 'Description',
            'Teacher_alias' => 'Teacher Alias',
			'IsAdmin' => 'Is Admin',
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

		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('First_name',$this->First_name,true);
		$criteria->compare('Last_name',$this->Last_name,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone_number',$this->Phone_number,true);
		$criteria->compare('Description',$this->Description,true);
        $criteria->compare('Teacher_alias',$this->Teacher_alias,true);
		$criteria->compare('IsAdmin',$this->IsAdmin);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getFullName()
    {
        return $this->First_name . ' ' . $this->Last_name;
    }

    public function beforeSave()
    {
        if (isset($this->Password))
        {
            $this->Password = md5($this->Password);
        }

        return parent::beforeSave();
    }
}