<?php

/**
 * This is the model class for table "User_to_content".
 *
 * The followings are the available columns in table 'User_to_content':
 * @property integer $User_to_content_ID
 * @property integer $User_ID
 * @property integer $Content_ID
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Content $content
 * @property User $user
 */
class UserToContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserToContent the static model class
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
		return 'User_to_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_ID, Content_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('User_to_content_ID, User_ID, Content_ID, Updated', 'safe'),
            array('Updated', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('Updated', 'default',
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
			'content' => array(self::BELONGS_TO, 'Content', 'Content_ID'),
			'user' => array(self::BELONGS_TO, 'User', 'User_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'User_to_content_ID' => 'User To Content',
			'User_ID' => 'User',
			'Content_ID' => 'Content',
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

		$criteria->compare('User_to_content_ID',$this->User_to_content_ID);
		$criteria->compare('User_ID',$this->User_ID);
		$criteria->compare('Content_ID',$this->Content_ID);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}