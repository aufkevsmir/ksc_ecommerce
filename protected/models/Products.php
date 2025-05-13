<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property integer $company_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property integer $stock
 * @property string $image_url
 * @property string $status
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Cart[] $carts
 * @property Inquiries[] $inquiries
 * @property OrderItems[] $orderItems
 * @property Companies $company
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, name, price', 'required'),
			array('company_id, stock', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>150),
			array('price', 'length', 'max'=>10),
			array('image_url', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('description, created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, name, description, price, stock, image_url, status, created_at', 'safe', 'on'=>'search'),
			array('category', 'in', 'range' => ['Electronics', 'Fashion', 'Home', 'Office', 'Automotive', 'Other']),
			array('category', 'safe'),
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
			'carts' => array(self::HAS_MANY, 'Cart', 'product_id'),
			'inquiries' => array(self::HAS_MANY, 'Inquiries', 'product_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'product_id'),
			'company' => array(self::BELONGS_TO, 'Companies', 'company_id'),
			'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'name' => 'Product Name',
			'description' => 'Description',
			'price' => 'Price',
			'stock' => 'Stock',
			'image_url' => 'Image URL',
			'status' => 'Status',
			'created_at' => 'Created At',
			'category' => 'Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
