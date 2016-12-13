<?php

/**
 * This is the model class for table "{{tagihan}}".
 *
 * The followings are the available columns in table '{{tagihan}}':
 * @property string $id
 * @property string $nomor_tagihan
 * @property integer $id_pelanggan
 * @property double $total_tagihan
 * @property string $status_tagihan
 * @property string $tanggal_pembayaran
 * @property string $tanggal_input
 * @property integer $user_input
 */
class Tagihan extends CActiveRecord
{
    const STATUS_PAID = "paid";
    const STATUS_UNPAID = "unpaid";
    const STATUS_REFUND = "refund";
    const paid_invoice_series = "P-INV-";
    const unpaid_invoice_series = "UP-INV-";
    const refund_invoice_series = "RF-INV-";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{tagihan}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor_tagihan, tanggal_input, user_input', 'required'),
            array('id_pelanggan, user_input', 'numerical', 'integerOnly' => true),
            array('total_tagihan', 'numerical'),
            array('nomor_tagihan', 'length', 'max' => 32),
            array('status_tagihan', 'length', 'max' => 16),
            array('tanggal_pembayaran, catatan', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor_tagihan, id_pelanggan, total_tagihan, status_tagihan, tanggal_pembayaran, tanggal_input, user_input', 'safe', 'on' => 'search'),
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
            'items_rel' => array(self::HAS_MANY,'DetailTagihan','id_tagihan'),
            'items_count' => array(self::STAT,'DetailTagihan','id_tagihan'),
            'customer_rel' => array(self::BELONGS_TO,'Pelanggan','id_pelanggan')
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nomor_tagihan' => 'Nomor Tagihan',
            'id_pelanggan' => 'Id Pelanggan',
            'total_tagihan' => 'Total Tagihan',
            'status_tagihan' => 'Status Tagihan',
            'tanggal_pembayaran' => 'Tanggal Pembayaran',
            'catatan' => 'Catatan',
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
        $criteria->compare('nomor_tagihan', $this->nomor_tagihan, true);
        $criteria->compare('id_pelanggan', $this->id_pelanggan);
        $criteria->compare('total_tagihan', $this->total_tagihan);
        $criteria->compare('status_tagihan', $this->status_tagihan, true);
        $criteria->compare('tanggal_pembayaran', $this->tanggal_pembayaran, true);
        $criteria->compare('catatan', $this->catatan, true);
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
     * @return Tagihan the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Buat nomor invoice baru
     * @param string $status
     * @return string
     */
    public function getInvoiceNumber($status = 'paid')
    {
        switch ($status){
            case self::STATUS_PAID:
                $serie = self::paid_invoice_series;
                break;
            case self::STATUS_UNPAID:
                $serie = self::unpaid_invoice_series;
                break;
            case self::STATUS_REFUND:
                $serie = self::refund_invoice_series;
                break;
        }

        $criteria = new CDbCriteria;
        $criteria->compare('status_tagihan', $status);
        $criteria->order = 'id DESC';
        $model = self::model()->find($criteria);
        $next_nr = 0;
        if(!empty($model->nomor_tagihan)){
            $explode = explode($serie, $model->nomor_tagihan);
            $next_nr = (int)$explode[1];
        }
        $next_nr = $next_nr + 1;
        $next_nr = str_repeat('0', 4-strlen($next_nr)).$next_nr;

        return $serie.''.$next_nr;
    }

    public function getTotalDiscount($id=0)
    {
        if($id==0)
            $id = $this->id;

        $query = 'SELECT SUM(diskon) AS amount FROM '.Yii::app()->db->tablePrefix.'detail_tagihan WHERE id_tagihan='.$id.'';
        $rows = Yii::app()->db->createCommand($query)->queryAll();

        return $rows[0]['amount'];
    }

    public function getTotalPrice($id=0)
    {
        if($id==0)
            $id = $this->id;

        $query = 'SELECT SUM(harga) AS amount FROM '.Yii::app()->db->tablePrefix.'detail_tagihan WHERE id_tagihan='.$id.'';
        $rows = Yii::app()->db->createCommand($query)->queryAll();

        return $rows[0]['amount'];
    }

    public function getListStatus($status = null)
    {
        $items = array(
                self::STATUS_PAID => 'Paid',
                self::STATUS_UNPAID => 'Unpaid',
                self::STATUS_REFUND => 'Refunded',

            );

        return (empty($status))? $items : $item[$status];
    }
}
