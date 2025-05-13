<?php

class Categories extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'categories';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name', 'length', 'max' => 255),
		);
	}

	public function relations()
	{
		return array(
			'products' => array(self::HAS_MANY, 'Products', 'category_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}
}
