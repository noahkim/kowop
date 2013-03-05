<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $User_ID
 * @property string $First_name
 * @property string $Last_name
 * @property string $Email
 * @property string $Password
 * @property string $Phone_number
 * @property string $Description
 * @property string $DisplayName
 * @property string $AccountURI
 * @property integer $IsAdmin
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property BankAccount[] $bankAccount
 * @property CreditCard[] $creditCards
 * @property Friend[] $friended
 * @property Friend[] $friendOf
 * @property Experience[] $experiences
 * @property Message[] $messages
 * @property Message[] $sentMessages
 * @property Request[] $requests
 * @property RequestToUser[] $requestToUsers
 * @property UserToContent[] $userToContents
 * @property UserToExperience[] $userToExperiences
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $experienceName active record class name.
     * @return User the static model class
     */
    public static function model($experienceName = __CLASS__)
    {
        return parent::model($experienceName);
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
            array('Email, Password, DisplayName', 'required'),
            array('First_name, Last_name, Email, Description, DisplayName', 'length', 'max' => 255),
            array('Phone_number', 'length', 'max' => 45),
            array('Password', 'length', 'min' => 1),
            array('Email', 'email'),
            array('Email', 'unique', 'allowEmpty' => false, 'caseSensitive' => false),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('User_ID, First_name, Last_name, Email, Phone_number, Description, DisplayName, AccountURI, IsAdmin, Created, Updated, profilePic', 'safe'),
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
            'experiences' => array(self::HAS_MANY, 'Experience', 'Create_user_ID', 'scopes' => array('active', 'current')),
            'requests' => array(self::HAS_MANY, 'Request', 'Create_User_ID'),
            'requestToUsers' => array(self::HAS_MANY, 'RequestToUser', 'User_ID'),
            'userToContents' => array(self::HAS_MANY, 'UserToContent', 'User_ID'),
            'messages' => array(self::HAS_MANY, 'Message', 'To'),
            'sentMessages' => array(self::HAS_MANY, 'Message', 'From'),
            'friended' => array(self::HAS_MANY, 'Friend', 'User_ID'),
            'friendOf' => array(self::HAS_MANY, 'Friend', 'Friend_User_ID'),
            'userToExperiences' => array(self::HAS_MANY, 'UserToExperience', 'User_ID'),
            'bankAccount' => array(self::HAS_ONE, 'BankAccount', 'User_ID', 'scopes' => array('active')),
            'creditCards' => array(self::HAS_MANY, 'CreditCard', 'User_ID', 'scopes' => array('active', 'saved')),
            // Added
            'requestsJoined' => array(self::HAS_MANY, 'Request', array('Request_ID' => 'Request_ID'), 'through' => 'requestToUsers'),
            'contents' => array(self::HAS_MANY, 'Content', array('Content_ID' => 'Content_ID'), 'through' => 'userToContents'),
            'sessions' => array(self::HAS_MANY, 'Session', array('Session_ID' => 'Session_ID'), 'through' => 'userToExperiences'),
            'enrolledIn' => array(self::HAS_MANY, 'Experience', array('Experience_ID' => 'Experience_ID'), 'through' => 'userToExperiences', 'scopes' => array('active', 'current')),
            'pastExperiencesHosted' => array(self::HAS_MANY, 'Experience', 'Create_user_ID', 'scopes' => array('active', 'past')),
            'allExperiencesHosted' => array(self::HAS_MANY, 'Experience', 'Create_user_ID'),

            'customerPayments' => array(self::HAS_MANY, 'Payment', array('Experience_ID' => 'Experience_ID'), 'through' => 'allExperiencesHosted'),
            'customerCards' => array(self::HAS_MANY, 'CreditCard', array('CreditCard_ID' => 'CreditCard_ID'), 'through' => 'customerPayments'),
            'customers' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'), 'through' => 'customerCards'),
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
            'DisplayName' => 'Teacher Alias',
            'AccountURI' => 'AccountURI',
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

        $criteria = new CDbCriteria;

        $criteria->compare('User_ID', $this->User_ID);
        $criteria->compare('First_name', $this->First_name, true);
        $criteria->compare('Last_name', $this->Last_name, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Phone_number', $this->Phone_number, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('DisplayName', $this->DisplayName, true);
        $criteria->compare('AccountURI', $this->AccountURI);
        $criteria->compare('IsAdmin', $this->IsAdmin);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFullName()
    {
        return $this->First_name . ' ' . $this->Last_name;
    }

    public function getProfilePic()
    {
        $numContents = count($this->contents);
        if ($numContents > 0)
        {
            return $this->contents[$numContents - 1]->Link;
        }

        return 'http://placehold.it/300x300';
    }

    public function setProfilePic($value)
    {
        if (!is_numeric($value))
        {
            return false;
        }

        while (count($this->userToContents) > 0)
        {
            $this->userToContents[0]->delete();
        }

        $userToContent = new UserToContent;
        $userToContent->Content_ID = $value;
        $userToContent->User_ID = $this->User_ID;
        $saved = $userToContent->save();

        return $saved;
    }

    public function getFriends()
    {
        $friended = $this->friended(array('condition' => 'Status = ' . FriendStatus::Friend));
        $friendOf = $this->friendOf(array('condition' => 'Status = ' . FriendStatus::Friend));

        $friends = array();

        foreach ($friended as $friendship)
        {
            $friends[] = $friendship->friendUser;
        }

        foreach ($friendOf as $friendship)
        {
            $friends[] = $friendship->user;
        }

        return $friends;
    }

    public function isFriendsWith($id)
    {
        $isFriends = false;

        foreach ($this->friends as $friend)
        {
            if ($friend->User_ID == $id)
            {
                $isFriends = true;
                break;
            }
        }

        return $isFriends;
    }

    public function getDisplay()
    {
        $name = ($this->DisplayName == null) ? $this->fullname : $this->DisplayName;

        return $name;
    }
}
