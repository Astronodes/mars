<?php

/**
 * This is the model class for table "tbl_project".
 *
 * The followings are the available columns in table 'tbl_project':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $images
 * @property integer $create_user_id
 * @property string $create_time
 * @property integer $update_user_id
 * @property string $update_time
 */
class Project extends AstroNodes
{
	public $checkBox = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'tbl_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('link', 'length', 'max'=>100),
			array('images', 'length', 'max'=>140),
			array('description, create_time, update_time, checkBox', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, link, images, create_user_id, create_time, update_user_id, update_time', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
			'link' => 'Link',
			'images' => 'Images',
			'create_user_id' => 'Create User',
			'create_time' => 'Create Time',
			'update_user_id' => 'Update User',
			'update_time' => 'Update Time',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getImages()
	{
		$image_location = explode(",", $this->images);
		array_pop($image_location);
		return $image_location;
	}

	public function getactiveImages()
	{
		$image_location = explode(",", $this->activeImages);
		//array_pop($image_location);
		return $image_location;
	}

	public function getThumbs()
	{
		$image_location = $this->getImages();
		$thumbs_location = str_replace('/images/', '/images/thumb/', $image_location);
	
		return $thumbs_location;
	}



}