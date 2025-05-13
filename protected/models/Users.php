<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $email
 * @property string $password_hash
 * @property string $full_name
 * @property string $role
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Cart[] $carts
 * @property Companies[] $companies
 * @property Inquiries[] $inquiries
 * @property Orders[] $orders
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('email, password_hash, role', 'required'),
			array('email', 'email'),
			array('email', 'unique', 'message' => 'This email is already registered.'),
			array('full_name', 'length', 'max' => 100),
			array('password_hash', 'length', 'min' => 6),
			array('role', 'in', 'range' => array('buyer', 'seller')),
			array('email, password_hash, full_name, role', 'safe'),
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
			'carts' => array(self::HAS_MANY, 'Cart', 'user_id'),
			'companies' => array(self::HAS_MANY, 'Companies', 'user_id'),
			'inquiries' => array(self::HAS_MANY, 'Inquiries', 'buyer_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'buyer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password_hash' => 'Password Hash',
			'full_name' => 'Full Name',
			'role' => 'Role',
			'created_at' => 'Created At',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password_hash',$this->password_hash,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
