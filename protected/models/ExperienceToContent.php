<?php

/**
 * This is the model class for table "Experience_to_content".
 *
 * The followings are the available columns in table 'Experience_to_content':
 * @property integer $Experience_to_content_ID
 * @property integer $Experience_ID
 * @property integer $Content_ID
 * @property integer $Created
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Experience $experience
 * @property Content $content
 */
class ExperienceToContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $experienceName active record class name.
	 * @return ExperienceToContent the static model class
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
		return 'Experience_to_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Experience_ID, Content_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Experience_to_content_ID, Experience_ID, Content_ID, Created, Updated', 'safe'),
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
			'experience' => array(self::BELONGS_TO, 'Experience', 'Experience_ID'),
			'content' => array(self::BELONGS_TO, 'Content', 'Content_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Experience_to_content_ID' => 'Experience To Content',
			'Experience_ID' => 'Experience',
			'Content_ID' => 'Content',
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

		$criteria->compare('Experience_to_content_ID',$this->Experience_to_content_ID);
		$criteria->compare('Experience_ID',$this->Experience_ID);
		$criteria->compare('Content_ID',$this->Content_ID);
        $criteria->compare('Created',$this->Created,true);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
