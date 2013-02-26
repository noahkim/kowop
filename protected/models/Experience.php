<?php

/**
 * This is the model class for table "Experience".
 *
 * The followings are the available columns in table 'Experience':
 * @property integer $Experience_ID
 * @property integer $Create_User_ID
 * @property string $Name
 * @property string $Description
 * @property string $Start
 * @property string $End
 * @property integer $Min_occupancy
 * @property integer $Max_occupancy
 * @property integer $Location_ID
 * @property integer $Category_ID
 * @property string $Price
 * @property integer $Audience
 * @property integer $ExperienceType
 * @property integer $AppropriateAges
 * @property string $Offering
 * @property string $FinePrint
 * @property integer $MaxPerPerson
 * @property integer $MultipleAllowed
 * @property integer $Status
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Location $location
 * @property Category $category
 * @property User $createUser
 * @property ExperienceToContent[] $experienceToContents
 * @property ExperienceToTag[] $experienceToTags
 * @property Payment[] $payments
 * @property Rating[] $ratings
 * @property Request[] $requests
 * @property Session[] $sessions
 * @property UserToExperience[] $userToExperiences
 */
class Experience extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $experienceName active record class name.
     * @return Experience the static model class
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
        return 'Experience';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('Name, Description, Start, End, Category_ID, Audience, ExperienceType, Offering',
            'required'),
            array('Create_User_ID, Min_occupancy, Max_occupancy, Location_ID, Category_ID, Audience, ExperienceType, AppropriateAges, Status, MaxPerPerson, MultipleAllowed',
                'numerical', 'integerOnly' => true), array('Name', 'length', 'max' => 255),
            array('Description', 'length', 'max' => 2000),
            array('Offering, FinePrint', 'length', 'max' => 1000), array('Price', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Experience_ID, Create_User_ID, Name, Description, Start, End, Min_occupancy, Max_occupancy, Location_ID, Category_ID, Price, Audience, ExperienceType, AppropriateAges, Offering, FinePrint, MaxPerPerson, MultipleAllowed, Status, Created, Updated, tagString, locationStreet, locationCity, locationState, locationZip',
                'safe'),
            array('Updated', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false,
                'on' => 'update'),
            array('Created,Updated', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false,
                'on' => 'insert'));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('location' => array(self::BELONGS_TO, 'Location', 'Location_ID'),
            'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
            'createUser' => array(self::BELONGS_TO, 'User', 'Create_User_ID'),
            'experienceToContents' => array(self::HAS_MANY, 'ExperienceToContent', 'Experience_ID'),
            'experienceToTags' => array(self::HAS_MANY, 'ExperienceToTag', 'Experience_ID'),
            'requests' => array(self::HAS_MANY, 'Request', 'Created_Experience_ID'),
            'sessions' => array(self::HAS_MANY, 'Session', 'Experience_ID'),
            'userToExperiences' => array(self::HAS_MANY, 'UserToExperience', 'Experience_ID'),
            'payments' => array(self::HAS_MANY, 'Payment', 'Experience_ID'),

            // Added

            'contents' => array(self::HAS_MANY, 'Content', array('Content_ID' => 'Content_ID'),
                'through' => 'experienceToContents'),
            'tags' => array(self::HAS_MANY, 'Tag', array('Tag_ID' => 'Tag_ID'),
                'through' => 'experienceToTags'),
            'enrolled' => array(self::HAS_MANY, 'User', array('User_ID' => 'User_ID'),
                'through' => 'userToExperiences'),
            'currentSessions' => array(self::HAS_MANY, 'Session', 'Experience_ID', 'scopes' => array('current')),
        );
    }

    public function scopes()
    {
        $t = $this->getTableAlias(false);

        return array(
            'active' => array('condition' => "{$t}.Status = " . ExperienceStatus::Active),
            'inactive' => array('condition' => "{$t}.Status = " . ExperienceStatus::Inactive),
            'past' => array('condition' => "{$t}.End <= now()"),
            'current' => array('condition' => "{$t}.End > now()"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('Experience_ID' => 'Experience', 'Create_User_ID' => 'Create User', 'Name' => 'Name',
            'Description' => 'Description', 'Start' => 'Start', 'End' => 'End',
            'Min_occupancy' => 'Min Occupancy', 'Max_occupancy' => 'Max Occupancy',
            'Location_ID' => 'Location', 'Category_ID' => 'Category', 'Price' => 'Price',
            'Audience' => 'Audience', 'ExperienceType' => 'Experience Type',
            'AppropriateAges' => 'AppropriateAges', 'Offering' => 'Offering', 'FinePrint' => 'Fine Print',
            'MaxPerPerson' => 'Max per person', 'MultipleAllowed' => 'Multiple allowed', 'Status' => 'Status',
            'Created' => 'Created', 'Updated' => 'Updated',);
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

        $criteria->compare('Experience_ID', $this->Experience_ID);
        $criteria->compare('Create_User_ID', $this->Create_User_ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('Start', $this->Start, true);
        $criteria->compare('End', $this->End, true);
        $criteria->compare('Min_occupancy', $this->Min_occupancy);
        $criteria->compare('Max_occupancy', $this->Max_occupancy);
        $criteria->compare('Location_ID', $this->Location_ID);
        $criteria->compare('Category_ID', $this->Category_ID);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('Audience', $this->Audience);
        $criteria->compare('ExperienceType', $this->Type);
        $criteria->compare('AppropriateAges', $this->AppropriateAges);
        $criteria->compare('Offering', $this->Offering);
        $criteria->compare('FinePrint', $this->FinePrint);
        $criteria->compare('MaxPerPerson', $this->MaxPerPerson);
        $criteria->compare('MultipleAllowed', $this->MultipleAllowed);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Created', $this->Created, true);
        $criteria->compare('Updated', $this->Updated, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    public function getTagList()
    {
        $tags = array();

        foreach ($this->tags as $tag)
        {
            array_push($tags, $tag->Name);
        }

        return $tags;
    }

    public function getTagString()
    {
        return Tag::model()->array2string($this->taglist);
    }

    public function setTagString($value)
    {
        ExperienceToTag::model()->deleteAll('Experience_ID=:Experience_ID', array(':Experience_ID' => $this->Experience_ID));

        $tagsArray = Tag::model()->string2array($value);
        foreach ($tagsArray as $tagName)
        {
            $tag = Tag::model()->findOrCreate($tagName);

            $experienceToTag = new ExperienceToTag;
            $experienceToTag->Experience_ID = $this->Experience_ID;
            $experienceToTag->Tag_ID = $tag->Tag_ID;
            $experienceToTag->save();
        }
    }

    public function getPicture()
    {
        $numContents = count($this->contents);
        if ($numContents > 0)
        {
            return $this->contents[$numContents - 1]->Link;
        }

        return null;
    }

    public function getNextAvailableSession()
    {
        if ($this->sessions == null)
        {
            return null;
        }

        $upcoming = $this->sessions(array('condition' => 'Start >= now()', 'order' => 'Start asc'));

        if (count($upcoming) > 0)
        {
            return $upcoming[0];
        }

        return null;

    }

    public function getHasSessions()
    {
        return (count($this->sessions) > 0);
    }

    public function getLocationStreet()
    {
        return $this->location->Address;
    }

    public function setLocationStreet($value)
    {
        $this->location->Address = $value;
        $this->location->save();
    }

    public function getLocationCity()
    {
        return $this->location->City;
    }

    public function setLocationCity($value)
    {
        $this->location->City = $value;
        $this->location->save();
    }

    public function getLocationState()
    {
        return $this->location->State;
    }

    public function setLocationState($value)
    {
        if(is_numeric($value))
        {
            $value = Location::GetStates()[$value];
        }

        $this->location->State = $value;
        $this->location->save();
    }

    public function getLocationZip()
    {
        return $this->location->Zip;
    }

    public function setLocationZip($value)
    {
        $this->location->Zip = $value;
        $this->location->save();
    }

    public function beforeSave()
    {
        if (isset($this->Start))
        {
            $this->Start = date('Y-m-d', strtotime($this->Start));
        }

        if (isset($this->End))
        {
            $this->End = date('Y-m-d', strtotime($this->End));
        }

        if (isset($this->Price) && ($this->Price == 0))
        {
            unset($this->Price);
        }

        $this->Create_User_ID = Yii::app()->user->id;

        return parent::beforeSave();
    }

    public function SignUp($session = null, $quantity = 1, $creditCard = null)
    {
        $transaction = $this->dbConnection->beginTransaction();

        try
        {
            $user = User::model()->findByPk(Yii::app()->user->id);

            if ($this->Create_User_ID == $user->User_ID)
            {
                throw new Exception("Can't sign up for own experience.");
            }

            $userToExperience = new UserToExperience();
            $userToExperience->User_ID = $user->User_ID;
            $userToExperience->Experience_ID = $this->Experience_ID;

            if ($session == null)
            {
                $existing = UserToExperience::model()->find('User_ID=:User_ID AND Experience_ID=:Experience_ID',
                    array(':User_ID' => $user->User_ID,
                        ':Experience_ID' => $this->Experience_ID));
            }
            else
            {
                $existing = UserToExperience::model()->find('User_ID=:User_ID AND Session_ID=:Session_ID AND Experience_ID=:Experience_ID',
                    array(':User_ID' => $user->User_ID,
                        ':Session_ID' => $session,
                        ':Experience_ID' => $this->Experience_ID));

                $userToExperience->Session_ID = $session;
            }

            if ($this->MaxPerPerson != null)
            {
                if ($quantity > $this->MaxPerPerson)
                {
                    throw new Exception("Quantity exceeds limit.");
                }
            }

            $userToExperience->Quantity = $quantity;

            if (($existing != null) && (!$this->MultipleAllowed))
            {
                throw new Exception("Can't sign up multiple times.");
            }

            if (isset($this->Price) && ($this->Price != null) && ($this->Price > 0))
            {
                $amount = $quantity * $this->Price;

                $scheduledFor = strtotime('+' . Yii::app()->params["PaymentDelay"] . ' days');

                if ($session != null)
                {
                    $sessionModel = Session::model()->findByPk($session);
                    $start = strtotime($sessionModel->Start);

                    if ($start < time())
                    {
                        throw new Exception("Session starts in the past.");
                    }

                    if ($start < $scheduledFor)
                    {
                        $scheduledFor = $start;
                    }
                }

                $payment = new Payment;
                $payment->Experience_ID = $this->Experience_ID;
                $payment->CreditCard_ID = $creditCard;
                $payment->BankAccount_ID = $this->createUser->bankAccount->BankAccount_ID;
                $payment->Amount = $amount;
                $payment->Batch_ID = uniqid();
                $payment->ScheduledFor = date('Y-m-d H:i:s', $scheduledFor);
                $payment->Status = PaymentStatus::Scheduled;
                $payment->save();
            }

            $userToExperience->save();

            $userName = CHtml::link($user->fullName, array('user/view', 'id' => $user->User_ID));
            $experienceName = CHtml::link($this->Name, array('experience/view', 'id' => $this->Experience_ID));

            Message::SendNotification($this->Create_User_ID,
                "{$userName} has joined your experience \"{$experienceName}\".");


            // Notify the enrollees
            foreach ($this->enrolled as $enrollee)
            {
                if ($enrollee->User_ID != $user->User_ID)
                {
                    $userName = CHtml::link($user->fullName, array('user/view', 'id' => $user->User_ID));
                    $experienceName = CHtml::link($this->Name, array('experience/view', 'id' => $this->Experience_ID));

                    Message::SendNotification($enrollee->User_ID,
                        "{$userName} has also joined the experience \"{$experienceName}\".");
                }
            }

            $transaction->commit();
        }
        catch (Exception $e)
        {
            $transaction->rollback();

            return false;
        }

        return true;
    }
}
