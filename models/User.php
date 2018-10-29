<?php

namespace app\models;

use app\models\tables\Roles;
use Yii;
use app\models\tables\Users;
use yii\base\Model;

class User extends Model implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $password_repeat;
    public $first_name;
    public $last_name;
    public $email;
    public $authKey;
    public $accessToken;
    public $captcha;
    
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['id', 'username', 'password', 'first_name', 'last_name'];
        $scenarios[self::SCENARIO_REGISTER] = ['username', 'first_name', 'last_name', 'email', 'password', 'password_repeat', 'captcha'];
        return $scenarios;
    }
    
    public function rules() {
        return [
            [['username', 'password', 'password_repeat', 'first_name', 'last_name', 'email'], 'required'],
            [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 50],
            [['password', 'password_repeat'], 'string', 'max' => 100, 'min' => 5],
            ['password', 'compare'],
            ['email', 'email'],
            ['captcha', 'captcha']
        ];
    }
    
    public function attributeLabels() {
        return [
            'username' => Yii::t('app/tables', 'Имя пользователя'),
            'password' => Yii::t('app/tables', 'Повтор пароля'),
            'password_repeat' => Yii::t('app/tables', 'Пароль'),
            'first_name' => Yii::t('app/tables', 'Имя'),
            'last_name' => Yii::t('app/tables', 'Фамилия'),
            'email' => 'Email',
            'captcha' => Yii::t('app/tables', 'Капча')
        ];
    }
    
    
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
    
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        if ($userDb = Users::findOne($id)) {
            $user = new static(['scenario' => User::SCENARIO_LOGIN]);
            $user->setAttributes($userDb->attributes);
            return $user;
        }
        return null;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        
        return null;
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        if ($userDb = Users::findOne(['username' => $username])) {
            $user = new static(['scenario' => User::SCENARIO_LOGIN]);
            $user->setAttributes($userDb->attributes);
            return $user;
        }
        return null;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->authKey;
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
    public function save() {
        if ($this->validate()) {
            $model = new Users();
            $model->setAttributes($this->attributes);
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $model->setAttribute('role_id', Roles::findOne(['name' => Yii::$app->params['defaultRole']])->id);
            
            if ($model->save()) {
                return true;
            }
            $arrErr = [];
            foreach ($model->errors as $key => $error) {
                $arrErr[$key] = $error[0];
            }
            $this->addErrors($arrErr);
        }
        return false;
    }
}
