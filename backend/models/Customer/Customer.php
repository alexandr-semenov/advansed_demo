<?php

namespace backend\models\Customer;

use yii\db\ActiveRecord;

/**
 * Class Customer
 *
 * @property $id
 * @property $age
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $phone
 */
class Customer extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'customers';
    }

    public function rules()
    {
        return [
            [['age', 'first_name', 'last_name', 'email', 'phone'], 'safe']
        ];
    }
}
