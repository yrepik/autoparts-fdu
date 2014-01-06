<?php

/**
 * This is the model class for table "{{parts_item}}".
 *
 * The followings are the available columns in table '{{parts_item}}':
 * @property string $item_id
 * @property integer $item_category_id
 * @property string $item_caption
 * @property string $item_year
 * @property string $item_code
 * @property string $item_price
 * @property integer $item_quantity
 * @property string $item_image
 * @property string $item_updated
 */
class PartsItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PartsItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbDobloParts;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{parts_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_category_id, item_quantity', 'numerical', 'integerOnly'=>true),
			array('item_image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			array('item_image', 'safe', 'on'=>'update'),
			array('item_caption', 'length', 'max'=>255),
			array('item_year', 'length', 'max'=>9),
			array('item_code', 'length', 'max'=>127),
			array('item_price', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('item_id, item_caption, item_year, item_code, item_price, item_quantity', 'safe', 'on'=>'search'),
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
			'category'=>array(self::BELONGS_TO, 'PartsCategory', 'item_category_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => '№ запчасти',
			'item_category_id' => 'Категория',
			'item_caption' => 'Название запчасти',
			'item_year' => 'Год выпуска Fiat Doblo',
			'item_code' => 'Код запчасти',
			'item_price' => 'Цена, $',
			'item_quantity' => 'На складе',
			'item_image' => 'Изображение',
			'item_updated' => 'Обновление',
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

		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('item_category_id',$this->item_category_id);
		$criteria->compare('item_caption',$this->item_caption,true);
		$criteria->compare('item_year',$this->item_year,true);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('item_price',$this->item_price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}