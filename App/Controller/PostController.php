<?php

    namespace App\Controller;

    use App\inc\Controller;
    use App\Model\Post;

    class PostController extends Controller
    {
        function index()
        {
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
    }