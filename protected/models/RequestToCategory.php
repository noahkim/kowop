<?php

/**
 * This is the model class for table "Request_to_category".
 *
 * The followings are the available columns in table 'Request_to_category':
 * @property integer $Request_to_category_ID
 * @property integer $Request_ID
 * @property integer $Category_ID
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Request $request
 */
class RequestToCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RequestToCategory the static model class
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
		return 'Request_to_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Request_ID, Category_ID, Updated', 'required'),
			array('Request_ID, Category_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Request_to_category_ID, Request_ID, Category_ID, Updated', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
			'request' => array(self::BELONGS_TO, 'Request', 'Request_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Request_to_category_ID' => 'Request To Category',
			'Request_ID' => 'Request',
			'Category_ID' => 'Category',
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

		$criteria->compare('Request_to_category_ID',$this->Request_to_category_ID);
		$criteria->compare('Request_ID',$this->Request_ID);
		$criteria->compare('Category_ID',$this->Category_ID);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}