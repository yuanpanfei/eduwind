<?php

/**
 * This is the model class for table "ew_quiz".
 *
 * The followings are the available columns in table 'ew_quiz':
 * @property integer $id
 * @property string $title
 * @property string $description
 */
class Quiz extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{quiz}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('title', 'length', 'max'=>255),
		array('questionNum,reportNum','numerical'),
		array('description', 'safe'),
		// The following rule is used by search().
		// @todo Please remove those attributes that should not be searched.
		array('id, title, description', 'safe', 'on'=>'search'),
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
			'lesson'=>array(self::HAS_ONE,'Lesson','mediaId','on'=>'mediaType="quiz"'),
			'questions'=>array(self::HAS_MANY,'Question','quizId','order'=>'questions.weight asc'),
			'questionCount'=>array(self::STAT,'Question','quizId'),
			'reportCount'=>array(self::STAT,'QuizReport','quizId'),
			'avgScore'=>array(self::STAT,'QuizReport','quizId','select'=>'avg(score)'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Quiz the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function userReport($userId){
		$report = QuizReport::model()->findByAttributes(array('quizId'=>$this->id,'userId'=>$userId));
		return $report;
	}

}
