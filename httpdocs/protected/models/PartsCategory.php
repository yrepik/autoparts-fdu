<?php

/**
 * This is the model class for table "{{parts_category}}".
 *
 * The followings are the available columns in table '{{parts_category}}':
 * @property integer $category_id
 * @property integer $category_parent
 * @property string $category_caption
 * @property string $category_image
 * @property string $category_updated
 */
class PartsCategory extends CActiveRecord
{
	public $has_child;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PartsCategory the static model class
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
		return '{{parts_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_parent', 'numerical', 'integerOnly'=>true),
			// this will allow empty field when page is update
			array('category_image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			array('category_image', 'safe', 'on'=>'update'),
			array('category_caption', 'length', 'max'=>255),
			array('category_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, category_parent, category_caption', 'safe', 'on'=>'search'),
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
			'items'=>array(self::HAS_MANY, 'PartsItem', 'category_id'),
			'parent_categories'=>array(self::BELONGS_TO, 'PartsCategory', 'category_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => 'Категория №',
			'category_parent' => 'Главная категория',
			'category_caption' => 'Категория',
			'category_image' => 'Изображение',
			'category_updated' => 'Последнее обновление',
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_parent',$this->category_parent);
		$criteria->compare('category_caption',$this->category_caption,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns categories.
	 * @return categories list.
	 */
	public function getCategories()
	{
		$parents = array();
		$models=$this->findAll();
		
		foreach($models as $item){
			$category_parent = $item->getAttribute('category_parent');
			if($category_parent!=='0'){
				if(!in_array($category_parent, $parents)){
					array_push($parents, $category_parent);
				}
			}
		}
		
		foreach($models as $i=>$item){
			// Set has_child attribute for every records with parent category
			if(in_array($item->getAttribute('category_id'), $parents)){
				$item->setAttribute('has_child', '1');
			}
		}
			
		return $models;
	}
}