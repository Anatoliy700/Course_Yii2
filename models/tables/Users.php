<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int $role_id
 *
 * @property Tasks[] $tasks
 * @property Roles $role
 */
class Users extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'users';
  }
  
  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
      [['username', 'password', 'first_name', 'last_name', 'role_id'], 'required'],
      [['role_id'], 'integer'],
      [['username', 'first_name', 'last_name'], 'string', 'max' => 50],
      [['password'], 'string', 'max' => 100],
      [['username'], 'unique'],
      [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::class, 'targetAttribute' => ['role_id' => 'id']],
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'username' => 'Username',
      'password' => 'Password',
      'first_name' => 'First Name',
      'last_name' => 'Last Name',
      'role_id' => 'Role ID',
    ];
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTasks() {
    return $this->hasMany(Tasks::class, ['user_id' => 'id']);
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getRole() {
    return $this->hasOne(Roles::class, ['id' => 'role_id']);
  }
  
  static public function getArrAllUsers() {
    $users = self::find()->all();
    $usersArray = [];
    foreach ($users as $user) {
      $usersArray[$user->id] = $user->first_name . ' ' . $user->last_name;
    }
    
    return $usersArray;
  }
}
