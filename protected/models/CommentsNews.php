<?php

/**
 * This is the model class for table "comments_news".
 *
 * The followings are the available columns in table 'comments_news':
 * @property integer $id
 * @property string $name
 * @property string $message
 * @property string $created_at
 * @property integer $news_id
 *
 * The followings are the available model relations:
 * @property News $news
 */
class CommentsNews extends ActiveRecord
{
    /**
     *
     */
    const SCENARIO_ADMIN = 'admin';
    /**
     *
     */
    const SCENARIO_USER = 'user';

    /**
     * @var
     */
    public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comments_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['name, message, created_at, news_id', 'required'],
			['news_id', 'numerical', 'integerOnly'=>true],
			['name', 'length', 'max'=>255],
			// The following rule is used by search().
			['id, name, message, created_at, news_id', 'safe', 'on'=>'search'],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'news' => [self::BELONGS_TO, 'News', 'news_id'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
            'name' => Yii::t('main', 'Имя'),
            'message' => Yii::t('main', 'Комментарий'),
            'created_at' => Yii::t('main', 'Добавлено'),
			'news_id' => Yii::t('main', 'Новость'),
		];
	}


    /**
     * @param int $newsId
     * @return CActiveDataProvider
     */
    public function search($newsId = 0)
	{
        $criteria = new CDbCriteria;

        $criteria->compare('news_id', $newsId);

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['pageSizeComment'],
                'pageVar' =>'page',
//                'currentPage' => Yii::app()->getRequest()->getParam('page', 0)
            ],
        ]);
	}

    /**
     * @return CActiveDataProvider
     */
    public function searchAdmin()
    {
        $criteria = new CDbCriteria;

        if ($this->id) {
            $criteria->compare('id',$this->id);
        }
        if ($this->name) {
            $criteria->compare('name',$this->name,true);
        }
        if ($this->message) {
            $criteria->compare('message',$this->message,true);
        }
        if ($this->created_at) {
            $criteria->compare('created_at',$this->created_at,true);
        }
        if ($this->news_id) {
            $criteria->compare('news_id', $this->news_id);
        }

        return new CActiveDataProvider($this, [
            'criteria'=>$criteria,
            'sort' => [
                'defaultOrder' => 'created_at DESC',
            ],
            'pagination' => [
                'pageSize' => Yii::app()->params['admin']['pageSize'],
            ],
        ]);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CommentsNews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getPreviewComments($limit = 4)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'created_at DESC';
        $criteria->limit = $limit;

        return $this->findAll($criteria);
    }

    public function getShortNewsTitle()
    {
        $result = mb_substr($this->news->title, 0, 32, 'UTF-8');
        if (strlen($this->news->title) > 32) {
            $result .= '...';
        }

        return $result;
    }

    public function getShortMessage()
    {
        $result = mb_substr($this->message, 0, 75, 'UTF-8');

        if (strlen($this->news->title) > 75) {
            $result .= '...';
        }

        return $result;
    }
}
