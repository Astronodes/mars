<?php

/**
 * This is the model class for table "tbl_contact".
 *
 * The followings are the available columns in table 'tbl_contact':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $reason
 * @property string $phone
 * @property string $body
 * @property string $subject
 */
class Contact extends CActiveRecord
{
	const REASON_HI = 1;
	const REASON_PROJECT = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
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
		return 'tbl_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, body', 'required'),
			array('email', 'email'),
			array('reason', 'numerical', 'integerOnly'=>true),
			array('name, email, subject', 'length', 'max'=>64),
			array('phone', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, reason, phone, body, subject', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'reason' => 'Reason',
			'phone' => 'Phone',
			'body' => 'Body',
			'subject' => 'Subject',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('reason',$this->reason);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('subject',$this->subject,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}