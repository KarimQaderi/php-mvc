<?php

    namespace App\Model;


    use App\lib\DB\DB\PDO;

    class Post extends PDO
    {
        public function user()
        {
            return $this->belongsTo('users' , 'id' , 'user_id');
        }

    }