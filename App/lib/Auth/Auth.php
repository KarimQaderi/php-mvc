<?php


    namespace App\lib\Auth;

    use App\lib\Session\Session;
    use App\Model\User;

    class Auth
    {
        /**
         * login user
         *
         * @param $username
         * @param $password
         * @return bool
         */
        public static function login($username , $password)
        {
            $user = self::getUser($username , $password);

            if(empty($user))
                return false;

            Session::put('login_username' , $user['username']);
            Session::put('login_user_id' , $user['id']);

            return true;
        }

        /**
         * check has user
         *
         * @param $username
         * @param $password
         * @return bool
         */
        public static function check($username , $password)
        {
            if(empty(self::getUser($username , $password)))
                return false;
            else
                return true;
        }

        /**
         * check user guest or login
         *
         * @return bool
         */
        public static function guest()
        {
            return !Session::has('login_user_id');
        }

        /**
         * get Username
         *
         * @return string
         */
        public static function getUserName()
        {
            return Session::get('login_username');
        }

        /**
         * get Username id
         *
         * @return string
         */
        public static function getUserId()
        {
            return Session::get('login_user_id');
        }

        private static function getUser($username , $password)
        {
            return User::make()->where('username' , $username)->where('password' , md5($password))->first();
        }

        /**
         * logout user
         */
        public static function logout()
        {
            Session::forget('login_username');
            Session::forget('login_user_id' );
        }

    }