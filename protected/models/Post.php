<?php

/**
 * This is the model class for table "tbl_post".
 *
 * The followings are the available columns in table 'tbl_post':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $tags
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $createUser
 */
class Post extends AstroNodes
{
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ARCHIVED = 3;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'tbl_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status', 'required'),
			array('status', 'in', 'range' => array(1,2,3)),
			array('title', 'length', 'max'=>128),
			array('tags', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, status, tags, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id',
				'condition' => 'comments.status='.Comment::STATUS_APPROVED,
				'order' => 'comments.create_time DESC'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id', 
				'condition' => 'status=' . Comment::STATUS_APPROVED),
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
			'content' => 'Content',
			'status' => 'Status',
			'tags' => 'Tags',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function normalizeTags($attribute, $params)
	{
		$this->tags = Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	public function getUrl()
	{
		return Yii::app()->createUrl('post/view', array(
			'id' => $this->id,
			'title' => $this->title,
			));
	}

	protected function afterSave()
	{
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags, $this->tags);
	}

	private $_oldTags;

	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
	}

	protected function afterDelete()
	{
		parent::afterDelete();
		//Comment::model()->deleteAll('post_id='.$this->id);
		Tag::model()->updateFrequency($this->tags, '');
	}

	public function getTagLinks()
	{
		$links = array();
		foreach(Tag::string2array($this->tags) as $tags)
			$links[] = CHtml::link(CHtml::encode($tags), array('post/index', 'tag'=>$tags));
		return $links;
	}





	public function addComment($comment)
	{
		if(Yii::app()->params['commentNeedApproval'])
			$comment->status=Comment::STATUS_PENDING;
		else
			$comment->status=Comment::STATUS_APPROVED;
		$comment->post_id=$this->id;
		return $comment->save();
	}
	
}