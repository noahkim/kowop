<?php

/**
 * This is the model class for table "Category".
 *
 * The followings are the available columns in table 'Category':
 * @property integer $Category_ID
 * @property string $Name
 * @property string $Created
 *
 * The followings are the available model relations:
 * @property Experience[] $experiences
 * @property Request[] $requests
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $experienceName active record class name.
	 * @return Category the static model class
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
		return 'Category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Created', 'required'),
			array('Name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Category_ID, Name, Created', 'safe', 'on'=>'search'),
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
			'experiences' => array(self::HAS_MANY, 'Experience', 'Category_ID'),
			'requests' => array(self::HAS_MANY, 'Request', 'Category_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Category_ID' => 'Category',
			'Name' => 'Name',
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

		$criteria->compare('Category_ID',$this->Category_ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Created',$this->Created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function GetCategories()
    {
        $cats = Category::model()->findAll();

        $lookup = array();
        foreach($cats as $cat)
        {
            $lookup[$cat->Category_ID] = $cat->Name;
        }

        return $lookup;
    }
}
