<?php

/**
 * This is the model class for table "Request".
 *
 * The followings are the available columns in table 'Request':
 * @property integer $Request_ID
 * @property integer $Create_User_ID
 * @property string $Name
 * @property string $Description
 * @property integer $Created_Experience_ID
 * @property string $Zip
 * @property integer $Category_ID
 * @property integer $HasTuition
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property Experience $createdExperience
 * @property Category $category
 * @property RequestToTag[] $requestToTags
 * @property RequestToUser[] $requestToUsers
 */
class Request extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $experienceName active record class name.
	 * @return Request the static model class
	 */
	public static function model($experienceName=__CLASS__)
	{
		return parent::model($experienceName);
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
			array('Name, Category_ID, HasTuition, Zip', 'required'),
			array('Category_ID, HasTuition', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>255),
			array('Description', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Request_ID, Create_User_ID, Name, Description, Created_Experience_ID, Category_ID, HasTuition, Zip, Created, Updated', 'safe'),
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
			'createdExperience' => array(self::BELONGS_TO, 'Experience', 'Created_Experience_ID'),
            'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
			'requestToTags' => array(self::HAS_MANY, 'RequestToTag', 'Request_ID'),
            'tags' => array(self::HAS_MANY, 'Tag', array('Tag_ID' => 'Tag_ID'), 'through' => 'requestToTags'),
			'requestToUsers' => array(self::HAS_MANY, 'RequestToUser', 'Request_ID'),
            'requestors' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'), 'through' => 'requestToUsers'),
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
			'Name' => 'Name',
			'Description' => 'Description',
			'Created_Experience_ID' => 'Created Class',
			'Zip' => 'Zip',
            'Category_ID' => 'Category',
            'HasTuition' => 'Has Tuition',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Created_Experience_ID',$this->Created_Experience_ID);
		$criteria->compare('Zip',$this->Zip);
        $criteria->compare('Category_ID',$this->Category_ID);
        $criteria->compare('HasTuition',$this->HasTuition);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTagList()
    {
        $tags = array();

        foreach($this->tags as $tag)
        {
            array_push($tags, $tag->Name);
        }

        return $tags;
    }

    public function getTagString()
    {
        return Tag::model()->array2string($this->taglist);
    }

    public function hasUserJoined($user_ID)
    {
        $hasJoined = false;

        foreach($this->requestToUsers as $user)
        {
            if($user->User_ID == $user_ID)
            {
                $hasJoined = true;
                break;
            }
        }

        return $hasJoined;
    }

    public function beforeSave()
    {
        $this->Create_User_ID = Yii::app()->user->id;

        return parent::beforeSave();
    }
}
