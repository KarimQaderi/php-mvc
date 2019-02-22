<?php

    namespace App\Controller;

    use App\inc\Controller;
    use App\lib\Auth\Auth;
    use App\lib\Cache\Cache;
    use App\lib\Config\Config;
    use App\lib\Cookie\Cookie;
    use App\lib\Session\Session;
    use App\Model\Post;

    class PostController extends Controller
    {
        function index()
        {

            Auth::login('admin' , '123456');

            dump(Config::get('Config.cache' , 'default'));

            Cookie::put('ddsshhh' , 'shhss' , 1);
//            Cookie::forget('ddsshhh');
            dump(Cookie::get('ddsshhh'));


            Cache::remember('post' , '1' , function(){
                return 'ssgggggggggghhhhhhhhhhhhhhs';
            });

            Cache::setDriver('file')->add('ffffffff' , 'rtyrty11111' , 1);

            dump(Cache::get('ffffffff'));
            dump(Cache::get('post'));

            Cookie::put('test' , "OK Test" , 2);
            Cookie::put('tesadst' , 'OK Test' , 3);


            Session::put('test' , 'OK Test');
            Session::put('test-2' , 'OK Test-2');

            Session::flash('massage' , 'LLFF');
            dump(Cookie::all());
            dump(Session::all());
            dump(Session::has('test'));
            Session::forget('test');
            Cookie::forget('test');
            dump(Session::has('test'));
            Session::flash('fffffff' , 'LytutyutyutyuLFF');


            dump(Cookie::all());

            dump(Session::all());


            Post::make()->find('2')->update([
                'title' => 'مجله در ستون'
            ]);


//            Post::make()->insert([
//                'title'=>"sdf sdf'sdf",
//                'body' => 'موضوع برنامه نا وع برنامه نا وع برنامه نا وع برنامه نامه نویسی',
//                'img' => '',
//            ]);

            Post::make()->delete(6);

            $this->view('post' , [
                'posts' => Post::make()->get() ,
            ]);
        }

        function Post()
        {
            $this->view('post' , [
                'name' => 'Karim' ,
                'family' => 'Qaderi'
            ]);

        }

        function Add()
        {

            dd($_POST);
        }

        function Show($id)
        {
            if(Auth::guest())
                dump('شما مهمان هستید');
            else
                dump('شما لاگین شدید');

            dump('Welcome ' . Auth::getUserName());
            dd($id);
        }
    }