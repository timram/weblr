<?php
require_once 'app/validators/BlogValidator.class.php';
require_once 'app/models/Blog.class.php';

function getPathToImage() {
    if (isset($_FILES['blog-image']) && $_FILES['blog-image']['size'] > 0) {
        $check = getimagesize($_FILES['blog-image']['tmp_name']);
        if ($check) {
            $tmp_name = $_FILES["blog-image"]["tmp_name"];
            $name = basename($_FILES["blog-image"]["name"]);
            move_uploaded_file($tmp_name, "public/img/blog/$name");
            return "public/img/blog/$name";
        }
    }
}

class BlogPage {
    private static $limit = 5;

    public static function getPage() {
        session_unset();

        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 1;

        $offset = $offset < 1 ? 1 : $offset;

        include 'app/views/pages/blog.php';
    }

    public static function addPost() {
        session_unset();

        $formValidity = [
            'subject' => ContactsValidator::checkNotEmpty('subject'),
            'text' => ContactsValidator::checkNotEmpty('text')
        ];

        $_SESSION['form_validity'] = $formValidity;

        $isIncorrectExists = array_search(false, $formValidity);

        $pathToImage = getPathToImage();

        if (!$isIncorrectExists) {
            $blog = new Blog([
                'subject' => $_POST['subject'],
                'text' => $_POST['text']
            ]);
            
            if ($pathToImage) {
                $blog->updateValue('path_to_image', $pathToImage);
            }

            $blog->save();
        }

        $_POST = array();   

        $offset = 1;

        include 'app/views/pages/blog.php';
    }
}

?> 