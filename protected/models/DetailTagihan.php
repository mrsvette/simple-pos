<?php

/**
 * This is the model class for table "{{detail_tagihan}}".
 *
 * The followings are the available columns in table '{{detail_tagihan}}':
 * @property string $id
 * @property integer $id_tagihan
 * @property integer $id_produk
 * @property integer $jumlah
 * @property double $harga
 * @property double $diskon
 * @property integer $id_promosi
 */
class DetailTagihan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{detail_tagihan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tagihan, id_produk', 'required'),
			array('id_tagihan, id_produk, jumlah, id_promosi', 'numerical', 'integerOnly'=>true),
			array('harga, diskon', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_tagihan, id_produk, jumlah, harga, diskon, id_promosi', 'safe', 'on'=>'search'),
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
			'tagihan_rel' => array(self::BELONGS_TO,'Tagihan','id_tagihan'),
			'produk_rel' => array(self::BELONGS_TO,'Produk','id_produk'),
			'promosi_rel' => array(self::BELONGS_TO,'Promosi','id_promosi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_tagihan' => 'Id Tagihan',
			'id_produk' => 'Id Produk',
			'jumlah' => 'Jumlah',
			'harga' => 'Harga',
			'diskon' => 'Diskon',
			'id_promosi' => 'Id Promosi',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_tagihan',$this->id_tagihan);
		$criteria->compare('id_produk',$this->id_produk);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('id_promosi',$this->id_promosi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetailTagihan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
