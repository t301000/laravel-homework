<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Backpack\Base\app\Models\BackpackUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NTPCOpenIDController extends Controller
{
    // 欄位對應
    protected $fieldsMap = [
        'namePerson/friendly' => 'nickname', //暱稱
        'contact/email' => 'email', //公務信箱
        'namePerson' => 'name', //姓名
        'birthDate' => 'birthday', //出生年月日，如： 1973-01-16
        'person/gender' => 'gender', //性別
        'contact/postalCode/home' => 'identifyCode', //識別碼
        'contact/country/home' => 'schoolNameShort', //單位（學校名），如：育林國中
        'pref/language' => 'classInfo', //年級班級座號 6 碼
        'pref/timezone' => 'authInfo', // 授權資訊[[學校別、身分別、職稱別、職務別[]]]
        'openid' => 'openid', // OpenID 帳號
    ];

    /**
     * 更新或新增 user，並賦予 角色，登入後轉向至原本想去的頁面或首頁
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register()
    {
        $data = $this->transformKey(session(config('ntpcopenid.sessionKey')));
        $email = array_pull($data, 'email');
        $data['password'] = bcrypt(str_random());
        $user = BackpackUser::updateOrCreate(compact('email'), $data);

        switch ($data['authInfo']['role']) {
            case '學生':
                $user->assignRole('學生');
                break;
            case '教師':
                $user->assignRole('教師');
                break;
        }

        Auth::login($user);

        return redirect()->intended();
    }

    /**
     * 轉換陣列的 key 為有意義的 key
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function transformKey(array $data)
    {
        $transformed[$this->fieldsMap['pref/timezone']] = array_pull($data, 'pref/timezone')[0];
        foreach ($data as $k => $v) {
            $transformed[$this->fieldsMap[$k]] = $v;
        }

        return $transformed;
    }
}
