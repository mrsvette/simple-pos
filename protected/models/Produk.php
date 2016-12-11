<?php

/**
 * This is the model class for table "{{produk}}".
 *
 * The followings are the available columns in table '{{produk}}':
 * @property integer $id
 * @property string $nama_produk
 * @property string $deskripsi_produk
 * @property string $jenis_produk
 * @property double $harga_produk
 * @property string $tanggal_input
 * @property integer $user_input
 */
class Produk extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{produk}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama_produk, user_input', 'required'),
            array('user_input', 'numerical', 'integerOnly' => true),
            array('harga_produk', 'numerical'),
            array('nama_produk', 'length', 'max' => 128),
            array('jenis_produk', 'length', 'max' => 64),
            array('deskripsi_produk, tanggal_input', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama_produk, deskripsi_produk, jenis_produk, harga_produk, tanggal_input, user_input', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nama_produk' => 'Nama Produk',
            'deskripsi_produk' => 'Deskripsi Produk',
            'jenis_produk' => 'Jenis Produk',
            'harga_produk' => 'Harga Produk',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nama_produk', $this->nama_produk, true);
        $criteria->compare('deskripsi_produk', $this->deskripsi_produk, true);
        $criteria->compare('jenis_produk', $this->jenis_produk, true);
        $criteria->compare('harga_produk', $this->harga_produk);
        $criteria->compare('tanggal_input', $this->tanggal_input, true);
        $criteria->compare('user_input', $this->user_input);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Produk the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Fungsi untuk menampilkan data produk di halaman transaksi penjualan
     * contoh cara memanggil fungsi ini : Produk::list_items('Pilih Pelanggan')
     * @param null $title
     * @return array
     */
    public function list_items($title=null)
    {
        $sql = "SELECT CONCAT(id,' - ',nama_produk) AS item FROM ".Yii::app()->db->tablePrefix."produk";
        $command = Yii::app()->db->createCommand($sql);
        $items = array();
        if(!empty($title))
            $items[''] = $title;
        foreach($command->query() as $row){
            $name = $row['item'];
            $items[$name] = $name;
        }
        return $items;
    }
}
