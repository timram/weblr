<?php
require_once 'app/controllers/AboutMe.class.php';
require_once 'app/controllers/Home.class.php';
require_once 'app/controllers/Interestings.class.php';
require_once 'app/controllers/Album.class.php';
require_once 'app/controllers/History.class.php';
require_once 'app/controllers/Study.class.php';
require_once 'app/controllers/TestPage.class.php';
require_once 'app/controllers/Contacts.class.php';
require_once 'app/controllers/NotFound.class.php';
require_once 'app/controllers/BlogPage.class.php';
require_once 'app/controllers/GuestBook.class.php';

class Router {
    public static function proceed($path) {
        $routes = self::getRoutes();
        if (isset($routes->$path)) {
            $controller = $routes->$path->controller;
            $method = $routes->$path->method;
            $controller::$method();
        } else {
            NotFound::getPage();
        }
    }

    private static function getRoutes() {
        return (object) [
            'GET/' => (object) ['controller' => 'Home', 'method' => 'getPage'],
            'GET/home' => (object) ['controller' => 'Home', 'method' => 'getPage'],
            'GET/about-me' => (object) ['controller' => 'AboutMe', 'method' => 'getPage'],
            'GET/interestings' => (object) ['controller' => 'Interestings', 'method' => 'getPage'],
            'GET/album' => (object) ['controller' => 'Album', 'method' => 'getPage'],
            'GET/test' => (object) ['controller' => 'TestPage', 'method' => 'getPage'],
            'GET/test-results' => (object) ['controller' => 'TestPage', 'method' => 'viewResults'],
            'POST/test' => (object) ['controller' => 'TestPage', 'method' => 'validateForm'],
            'GET/study' => (object) ['controller' => 'Study', 'method' => 'getPage'],
            'GET/contacts' => (object) ['controller' => 'Contacts', 'method' => 'getPage'],
            'POST/contacts' => (object) ['controller' => 'Contacts', 'method' => 'validateForm'],
            'GET/history' => (object) ['controller' => 'History', 'method' => 'getPage'],
            'GET/blog' => (object) ['controller' => 'BlogPage', 'method' => 'getPage'],
            'POST/blog' => (object) ['controller' => 'BlogPage', 'method' => 'addPost'],
            'GET/guestbook' => (object) ['controller' => 'GuestBook', 'method' => 'getPage'],
            'POST/guestbook' => (object) ['controller' => 'GuestBook', 'method' => 'addReview'],
            'POST/guestbook-upload' => (object) ['controller' => 'GuestBook', 'method' => 'loadReviewsFromFile']
        ]; 
    }
}

?>