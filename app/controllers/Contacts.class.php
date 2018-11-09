<?php
require_once 'app/validators/ContactsValidator.class.php';

class Contacts {    
    public static function getPage() {
        session_unset();
        // $blog = new Blog([
        //     'date' => date('Y-d-m H:i:s'),
        //     'subject' => 'super theme',
        //     'text' => 'WTF???'
        // ]);
            
        // $blog->save();
        include 'app/views/pages/contacts.php';
    }

    public static function validateForm() {
        $_SESSION['form_validity'] = array(
            'fio' => ContactsValidator::checkFIO('fio'),
            'phone' => ContactsValidator::checkPhone('phone'),
            'email' => ContactsValidator::checkMail('mail'),
            'subject' => ContactsValidator::checkNotEmpty('subject'),
            'message' => ContactsValidator::checkNotEmpty('message')
        );

        include 'app/views/pages/contacts.php';
    }
}

?> 