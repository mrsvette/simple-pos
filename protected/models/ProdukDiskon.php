<?php

/**
 * This is the model class for table "{{produk_diskon}}".
 *
 * The followings are the available columns in table '{{produk_diskon}}':
 * @property integer $id
 * @property integer $id_produk
 * @property integer $jumlah_produk
 * @property double $harga_produk
 * @property string $tanggal_mulai_diskon
 * @property string $tanggal_berakhir_diskon
 * @property string $tanggal_input
 * @property integer $user_input
 */
class ProdukDiskon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{produk_diskon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_produk, tanggal_input, user_input', 'required'),
			array('id_produk, jumlah_produk, user_input', 'numerical', 'integerOnly'=>true),
			array('harga_produk', 'numerical'),
			array('tanggal_mulai_diskon, tanggal_berakhir_diskon', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_produk, jumlah_produk, harga_produk, tanggal_mulai_diskon, tanggal_berakhir_diskon, tanggal_input, user_input', 'safe', 'on'=>'search'),
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
			'id_produk' => 'Id Produk',
			'jumlah_produk' => 'Jumlah Produk',
			'harga_produk' => 'Harga Produk',
			'tanggal_mulai_diskon' => 'Tanggal Mulai Diskon',
			'tanggal_berakhir_diskon' => 'Tanggal Berakhir Diskon',
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
		$criteria->compare('id_produk',$this->id_produk);
		$criteria->compare('jumlah_produk',$this->jumlah_produk);
		$criteria->compare('harga_produk',$this->harga_produk);
		$criteria->compare('tanggal_mulai_diskon',$this->tanggal_mulai_diskon,true);
		$criteria->compare('tanggal_berakhir_diskon',$this->tanggal_berakhir_diskon,true);
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
	 * @return ProdukDiskon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
