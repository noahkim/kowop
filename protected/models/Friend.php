<?php

/**
 * This is the model class for table "Friend".
 *
 * The followings are the available columns in table 'Friend':
 * @property integer $Friend_ID
 * @property integer $User_ID
 * @property integer $Friend_User_ID
 * @property integer $Status
 * @property string $RequestMessage
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $friendUser
 */
class Friend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Friend the static model class
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
		return 'Friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_ID, Friend_User_ID, Status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Friend_ID, User_ID, Friend_User_ID, Status, RequestMessage, Updated, Created', 'safe'),
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
			'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
			'friendUser' => array(self::BELONGS_TO, 'User', 'Friend_User_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Friend_ID' => 'Friend',
			'User_ID' => 'User',
			'Friend_User_ID' => 'Friend User',
			'Status' => 'Status',
            'RequestMessage' => 'Request message',
			'Updated' => 'Updated',
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

		$criteria->compare('Friend_ID',$this->Friend_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Friend_User_ID',$this->Friend_User_ID);
		$criteria->compare('Status',$this->Status);
        $criteria->compare('RequestMessage',$this->RequestMessage);
		$criteria->compare('Updated',$this->Updated,true);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function CreateRequest($from, $to, $message)
    {
        $request = new Friend;
        $request->User_ID = $from;
        $request->Friend_User_ID = $to;
        $request->Status = FriendStatus::AwaitingApproval;
        $request->RequestMessage = $message;

        if($request->save())
        {
            $fromUser = User::model()->findByPk($from);
            $fromLink = CHtml::link($fromUser->fullName, array('/user/view', 'id' => $from));

            Message::SendNotification($to, "Friend request from {$fromLink}", $message, $from, MessageType::FriendRequest);
        }

        return $request;
    }
}