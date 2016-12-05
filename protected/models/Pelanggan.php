<?php

/**
 * This is the model class for table "{{pelanggan}}".
 *
 * The followings are the available columns in table '{{pelanggan}}':
 * @property integer $id
 * @property string $nama_pelanggan
 * @property string $email_pelanggan
 * @property string $telepon_pelanggan
 * @property string $alamat_pelanggan
 * @property string $tanggal_input
 * @property integer $user_input
 */
class Pelanggan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pelanggan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_input', 'required'),
			array('user_input', 'numerical', 'integerOnly'=>true),
			array('nama_pelanggan, email_pelanggan', 'length', 'max'=>128),
			array('telepon_pelanggan', 'length', 'max'=>32),
			array('alamat_pelanggan, tanggal_input', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama_pelanggan, email_pelanggan, telepon_pelanggan, alamat_pelanggan, tanggal_input, user_input', 'safe', 'on'=>'search'),
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
			'nama_pelanggan' => 'Nama Pelanggan',
			'email_pelanggan' => 'Email Pelanggan',
			'telepon_pelanggan' => 'Telepon Pelanggan',
			'alamat_pelanggan' => 'Alamat Pelanggan',
			'tanggal_input' => 'Tanggal Input',
			'user_input' => 'User Input',
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
		$criteria->compare('nama_pelanggan',$this->nama_pelanggan,true);
		$criteria->compare('email_pelanggan',$this->email_pelanggan,true);
		$criteria->compare('telepon_pelanggan',$this->telepon_pelanggan,true);
		$criteria->compare('alamat_pelanggan',$this->alamat_pelanggan,true);
		$criteria->compare('tanggal_input',$this->tanggal_input,true);
		$criteria->compare('user_input',$this->user_input);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pelanggan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
