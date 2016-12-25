<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $status
 * @property string $hak_akses
 * @property string $tanggal_input
 * @property integer $user_input
 */
class User extends CActiveRecord
{
    const STATUS_AKTIF = 'aktif';
    const STATUS_TIDAK_AKTIF = 'tidak_aktif';

    public $password_baru;
    public $password_baru_diulang;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, tanggal_input, user_input', 'required'),
            array('user_input', 'numerical', 'integerOnly' => true),
            array('username, password', 'length', 'max' => 128),
            array('status', 'length', 'max' => 32),
            array('hak_akses, password_baru, password_baru_diulang', 'safe'),
            array('password_baru_diulang', 'checkOnChange'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, status, hak_akses, tanggal_input, user_input', 'safe', 'on' => 'search'),
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
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Status',
            'hak_akses' => 'Hak Akses',
            'tanggal_input' => 'Tanggal Input',
            'user_input' => 'User Input',
            'password_baru' => 'Password Baru',
            'password_baru_diulang' => 'Ulangi Password Baru',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('hak_akses', $this->hak_akses, true);
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
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password)
    {
        return md5($password);
    }

    public function checkOnChange($attribute, $params)
    {
        if (!empty($this->password_baru)) {
            if ($this->password_baru != $this->password_baru_diulang)
                $this->addError('password_baru_diulang', 'Ulangi password yang sama dengan password baru.');
        }
    }

    public function getListStatus($status = null)
    {
        $items = array(
            self::STATUS_AKTIF => 'Aktif',
            self::STATUS_TIDAK_AKTIF => 'Tidak Aktif'

        );

        return (empty($status)) ? $items : $items[$status];
    }

    public function getStatusInText($status = null)
    {
        if (empty($status)) {
            $status = $this->status;
        }
        $user_status = self::getListStatus($status);
        return $user_status;
    }
}
