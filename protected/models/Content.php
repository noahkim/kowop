<?php

/**
 * This is the model class for table "Content".
 *
 * The followings are the available columns in table 'Content':
 * @property integer $Content_ID
 * @property string $Content_type
 * @property string $Content_name
 * @property string $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property CourseToContent[] $courseToContents
 * @property UserToContent[] $userToContents
 */
class Content extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return 'Content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Content_type, Content_name, Created, Updated', 'required'),
			array('Content_type', 'length', 'max'=>45),
			array('Content_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Content_ID, Content_type, Content_name, Created, Updated', 'safe', 'on'=>'search'),
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
			'courseToContents' => array(self::HAS_MANY, 'CourseToContent', 'Content_ID'),
			'userToContents' => array(self::HAS_MANY, 'UserToContent', 'Content_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Content_ID' => 'Content',
			'Content_type' => 'Content Type',
			'Content_name' => 'Content Name',
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

		$criteria->compare('Content_ID',$this->Content_ID);
		$criteria->compare('Content_type',$this->Content_type,true);
		$criteria->compare('Content_name',$this->Content_name,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}