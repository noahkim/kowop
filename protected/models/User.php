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
 * @property UserToContent[] $userToContents
 * @property UserToSession[] $userToSessions
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
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
            array('First_name, Last_name, Password, Email, Description, Teacher_alias', 'length', 'max' => 255),
            array('Phone_number', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('User_ID, First_name, Last_name, Password, Email, Phone_number, Description, Teacher_alias, IsAdmin, Created, Updated', 'safe', 'on' => 'search'),
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
            'userToContents' => array(self::HAS_MANY, 'UserToContent', 'User_ID'),
            'contents' => array(self::HAS_MANY, 'Content', array('Content_ID' => 'Content_ID'), 'through' => 'userToContents'),
            'userToSessions' => array(self::HAS_MANY, 'UserToSession', 'User_ID'),
            'sessions' => array(self::HAS_MANY, 'Session', array('Session_ID' => 'Session_ID'), 'through' => 'userToSessions'),
            'enrolledIn' => array(self::HAS_MANY, 'KClass', array('Class_ID' => 'Class_ID'), 'through' => 'sessions'),
            'teachingSessions' => array(self::HAS_MANY, 'Session', array('Class_ID' => 'Class_ID'), 'through' => 'kClasses'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('User_ID', $this->User_ID);
        $criteria->compare('First_name', $this->First_name, true);
        $criteria->compare('Last_name', $this->Last_name, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('Phone_number', $this->Phone_number, true);
        $criteria->compare('Description', $this->Description, true);
        $criteria->compare('Teacher_alias', $this->Teacher_alias, true);
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

        return null;
    }

    public function getClassReport($filter)
    {
        $startDate = $filter->start;
        $endDate = $filter->end;
        $classFilter = $filter->classFilter;

        $conditions = [];

        if ($startDate != null)
        {
            $startDate = date('Y-m-d', strtotime($startDate));
            $conditions[] = "lessons.Start >= '{$startDate}'";
        }

        if ($endDate != null)
        {
            $endDate = date('Y-m-d', strtotime($endDate));
            $conditions[] = "lessons.End <= '{$endDate}'";
        }

        if ($classFilter == 'active')
        {
            $conditions[] = "lessons.Start <= now() AND lessons.End >= now()";
        }
        elseif ($classFilter == 'past')
        {
            $conditions[] = "lessons.End < now()";
        }
        elseif (is_numeric($classFilter))
        {
            $conditions[] = "teachingSessions.Class_ID = {$classFilter}";
        }

        $condition = '';
        if (count($conditions) > 0)
        {
            $condition = '(' . implode(') AND (', $conditions) . ')';
        }

        $sessions = $this->teachingSessions(array('with' => 'lessons', 'condition' => $condition));

        $results = array();
        $results['studentsToDate'] = 0;
        $results['netIncomeToDate'] = 0;
        $results['hoursTaught'] = 0;

        $results['studentsEnrolled'] = 0;
        $results['projectedIncome'] = 0;
        $results['hoursToTeach'] = 0;

        $results['avgPerClass'] = 0;
        $results['avgPerHour'] = 0;
        $results['netIncomeTeacher'] = 0;

        $totalHours = 0;
        $netIncome = 0;
        $classes = array();

        foreach ($sessions as $session)
        {
            $results['studentsToDate'] += count($session->students);
            $results['netIncomeToDate'] += $session->class->Tuition * count($session->students) * count($session->lessons(array('condition' => 'End <= now()')));
            $results['hoursTaught'] += $session->class->LessonDuration * count($session->lessons(array('condition' => 'End <= now()')));

            $results['studentsEnrolled'] += count($session->userToSessions(array('with' => 'lessons', 'condition' => 'lessons.Start > now()')));
            $results['projectedIncome'] += $session->class->Tuition * $session->class->Max_occupancy * count($session->lessons(array('condition' => 'Start > now()')));
            $results['hoursToTeach'] += $session->class->LessonDuration * count($session->lessons(array('condition' => 'Start > now()')));

            $netIncome += $session->class->Tuition * count($session->students) * count($session->lessons);
            $totalHours += $session->class->LessonDuration * count($session->lessons);
            $classes[$session->Class_ID] = 1;
        }

        $numClasses = array_sum($classes);
        if ($numClasses > 0)
        {
            $results['avgPerClass'] = $netIncome / $numClasses;
        }

        if ($totalHours > 0)
        {
            $results['avgPerHour'] = $netIncome / $totalHours;
        }

        $results['netIncomeTeacher'] = $netIncome;

        $results['avgPerClass'] = number_format($results['avgPerClass'], 2);
        $results['avgPerHour'] = number_format($results['avgPerHour'], 2);

        return $results;
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