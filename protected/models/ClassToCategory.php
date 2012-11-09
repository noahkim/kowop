<?php

/**
 * This is the model class for table "Class_to_category".
 *
 * The followings are the available columns in table 'Class_to_category':
 * @property integer $Class_to_category_ID
 * @property integer $Class_ID
 * @property integer $Category_ID
 * @property string $Updated
 *
 * The followings are the available model relations:
 * @property KClass $class
 * @property Category $category
 */
class ClassToCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassToCategory the static model class
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
		return 'Class_to_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Class_ID, Category_ID, Updated', 'required'),
			array('Class_ID, Category_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Class_to_category_ID, Class_ID, Category_ID, Updated', 'safe', 'on'=>'search'),
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
			'class' => array(self::BELONGS_TO, 'KClass', 'Class_ID'),
			'category' => array(self::BELONGS_TO, 'Category', 'Category_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Class_to_category_ID' => 'Class To Category',
			'Class_ID' => 'Class',
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

		$criteria->compare('Class_to_category_ID',$this->Class_to_category_ID);
		$criteria->compare('Class_ID',$this->Class_ID);
		$criteria->compare('Category_ID',$this->Category_ID);
		$criteria->compare('Updated',$this->Updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}