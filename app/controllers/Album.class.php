<?php

class Album {
    public static function getPage() {
        $_SESSION['images_config'] = array(
            array(
                'image' => 'public/img/1.jpg',
                'title' => 'Картинка 2',
                'description' => 'Описание картинки 2'
            ),
            array(
                'image' => 'public/img/2.jpeg',
                'title' => 'Картинка 3',
                'description' => 'Описание картинки 3'
            ),
            array(
                'image' => 'public/img/3.jpg',
                'title' => 'Картинка 4',
                'description' => 'Описание картинки 4'
            ),
            array(
                'image' => 'public/img/4.jpeg',
                'title' => 'Картинка 5',
                'description' => 'Описание картинки 5'
            ),
            array(
                'image' => 'public/img/5.jpg',
                'title' => 'Картинка 6',
                'description' => 'Описание картинки 6'
            ),
            array(
                'image' => 'public/img/6.jpeg',
                'title' => 'Картинка 7',
                'description' => 'Описание картинки 7'
            ),
            array(
                'image' => 'public/img/7.jpeg',
                'title' => 'Картинка 8',
                'description' => 'Описание картинки 8'
            ),
            array(
                'image' => 'public/img/8.jpeg',
                'title' => 'Картинка 9',
                'description' => 'Описание картинки 9'
            ),
            array(
                'image' => 'public/img/9.jpeg',
                'title' => 'Картинка 10',
                'description' => 'Описание картинки 10'
            ),
            array(
                'image' => 'public/img/10.jpeg',
                'title' => 'Картинка 11',
                'description' => 'Описание картинки 11'
            ),
            array(
                'image' => 'public/img/11.jpeg',
                'title' => 'Картинка 12',
                'description' => 'Описание картинки 12'
            ),
            array(
                'image' => 'public/img/12.jpg',
                'title' => 'Картинка 1',
                'description' => 'Описание картинки 1'
            ),
            array(
                'image' => 'public/img/13.jpg',
                'title' => 'Картинка 13',
                'description' => 'Описание картинки 13'
            ),
            array(
                'image' => 'public/img/14.jpeg',
                'title' => 'Картинка 14',
                'description' => 'Описание картинки 14'
            ),
            array(
                'image' => 'public/img/15.png',
                'title' => 'Картинка 15',
                'description' => 'Описание картинки 15'
            )
        );
        include 'app/views/pages/album.php';
    }
}

?>