php<?php

/**
 * This is the model class for table "{{promosi}}".
 *
 * The followings are the available columns in table '{{promosi}}':
 * @property string $id
 * @property string $kode_promosi
 * @property string $deskripsi
 * @property string $jenis_promosi
 * @property double $nilai_promosi
 * @property integer $maksimal_digunakan
 * @property integer $telah_digunakan
 * @property string $status_promosi
 * @property string $produk_yang_terdiskon
 * @property string $tanggal_mulai_promosi
 * @property string $tanggal_berakhir_promosi
 * @property string $tanggal_input
 * @property string $user_input
 */
class Promosi extends CActiveRecord
{
    const STATUS_AKTIF = "aktif";
    const STATUS_TIDAK_AKTIF = "tidak_aktif";
    const TYPE_ABSOLUTE = "absolute";
    const TYPE_PERCENTAGE = "percentage";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{promosi}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tanggal_input, user_input', 'required'),
            array('maksimal_digunakan, telah_digunakan', 'numerical', 'integerOnly' => true),
            array('nilai_promosi', 'numerical'),
            array('kode_promosi', 'length', 'max' => 100),
            array('jenis_promosi', 'length', 'max' => 30),
            array('status_promosi', 'length', 'max' => 32),
            array('deskripsi, produk_yang_terdiskon, tanggal_mulai_promosi, tanggal_berakhir_promosi', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kode_promosi, deskripsi, jenis_promosi, nilai_promosi, maksimal_digunakan, telah_digunakan, status_promosi, produk_yang_terdiskon, tanggal_mulai_promosi, tanggal_berakhir_promosi, tanggal_input, user_input', 'safe', 'on' => 'search'),
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
            'kode_promosi' => 'Kode Promosi',
            'deskripsi' => 'Deskripsi',
            'jenis_promosi' => 'Jenis Promosi',
            'nilai_promosi' => 'Nilai Promosi',
            'maksimal_digunakan' => 'Maksimal Digunakan',
            'telah_digunakan' => 'Telah Digunakan',
            'status_promosi' => 'Status Promosi',
            'produk_yang_terdiskon' => 'Produk Yang Terdiskon',
            'tanggal_mulai_promosi' => 'Tanggal Mulai Promosi',
            'tanggal_berakhir_promosi' => 'Tanggal Berakhir Promosi',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('kode_promosi', $this->kode_promosi, true);
        $criteria->compare('deskripsi', $this->deskripsi, true);
        $criteria->compare('jenis_promosi', $this->jenis_promosi, true);
        $criteria->compare('nilai_promosi', $this->nilai_promosi);
        $criteria->compare('maksimal_digunakan', $this->maksimal_digunakan);
        $criteria->compare('telah_digunakan', $this->telah_digunakan);
        $criteria->compare('status_promosi', $this->status_promosi, true);
        $criteria->compare('produk_yang_terdiskon', $this->produk_yang_terdiskon, true);
        $criteria->compare('tanggal_mulai_promosi', $this->tanggal_mulai_promosi, true);
        $criteria->compare('tanggal_berakhir_promosi', $this->tanggal_berakhir_promosi, true);
        $criteria->compare('tanggal_input', $this->tanggal_input, true);
        $criteria->compare('user_input', $this->user_input, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Promosi the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getDiscountValue($id, $price)
    {
        $model = self::model()->findByPk($id);
        if ($model->jenis_promosi == self::TYPE_PERCENTAGE)
            $discount = $price * $model->nilai_promosi / 100;
        else
            $discount = $price - $model->nilai_promosi;
        return $discount;
    }

    public function items($type = null)
    {

        $items = array(self::TYPE_ABSOLUTE => 'Absolute', self::TYPE_PERCENTAGE => 'Percentage');
        if (!empty($type))
            return $items[$type];
        else
            return $items;
    }
}
