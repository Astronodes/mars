<?php

/**
 * This is the model class for table "tbl_comment".
 *
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property integer $post_id
 * @property string $comment_author
 * @property string $content
 * @property integer $status
 * @property string $email
 * @property string $url
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Post $post
 */
class Comment extends CActiveRecord
{

	const STATUS_PENDING = 1;
	const STATUS_APPROVED = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'tbl_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_author, content, email', 'required'),
			array('comment_author, email, url', 'length', 'max'=>128),
			array('email', 'email'),
			array('url', 'url'),
			
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
			'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => 'Post',
			'comment_author' => 'Name',
			'content' => 'Comment',
			'status' => 'Status',
			'email' => 'Email',
			'url' => 'Website',
			'create_time' => 'Create Time',
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
/*
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('comment_author',$this->comment_author,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	*/}

	public function getUrl($post=null)
	{
		if($post===null)
			$post=$this->post;
		return $post->url.'#c'.$this->id;
	}

/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		if(!empty($this->url))
			return CHtml::link(CHtml::encode($this->comment_author),$this->url);
		else
			return CHtml::encode($this->comment_author);
	}

	public function approve()
	{
		$this->status=Comment::STATUS_APPROVED;
		$this->update(array('status'));
	}

	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
					'class' => 'zii.behaviors.CTimestampBehavior',
					'createAttribute' => 'create_time',
					'updateAttribute' => 'update_time',
					'setUpdateOnCreate' => true,
					),
			);
	}


	public function getPendingCommentCount()
	{
		return $this->count('status='.self::STATUS_PENDING);
	}
}