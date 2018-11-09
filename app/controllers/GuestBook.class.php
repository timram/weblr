<?php
    require_once 'app/validators/GuestBookValidator.class.php';

    function saveReview($review) {
        $filePath = './reviews.inc';
        $handle = fopen($filePath, 'a');
        $d = date('d.m.y');
        $data = $review['fio'] . ';' . $review['email'] . ';' . $review['review'] . ';' . $d . '\n';
        fwrite($handle, $data);
        fclose($handle);
    }

    function saveReviewsFromFile() {
        if (isset($_FILES['uploadFile']) && $_FILES['uploadFile']['size'] > 0) {
            $content = file_get_contents($_FILES['uploadFile']['tmp_name']);
            $splitted = explode('\n', $content);
            $labels = ['fio', 'email', 'review'];
            foreach($splitted as $row) {
                $review = ['fio' => '', 'email' => '', 'review' => ''];
                $splittedRow = explode(';', $row);
                $size = sizeof($splittedRow);
                for ($i = 0; $i < $size; $i++) {
                    $review[$labels[$i]] = $splittedRow[$i];
                }
                saveReview($review);
            }
        }
    }

    function getLabels() {
        return ['name', 'email', 'review', 'date'];
    }

    function mapper($row) {
        $splitted = explode(';', $row);
        $size = sizeof($splitted);
        $result = ['name' => '', 'email' => '', 'review' => '', 'date' => ''];
        $labels = getLabels();
        for ($i = 0; $i < $size; $i++) {
            $result[$labels[$i]] = $splitted[$i];
        }
        return $result;
    };

    function readReviews() {
        $filePath = './reviews.inc';
        $content = file_get_contents($filePath);

        return array_map('mapper', explode('\n', $content));
    }
    
    class GuestBook {
        public static function getPage() {
            session_unset();
            $reviews = readReviews();
            include 'app/views/pages/guestbook.php';
        }

        public static function addReview() {
            session_unset();

            $formValidity = [
                'fio' => GuestBookValidator::checkFIO('fio'),
                'email' => GuestBookValidator::checkMail('email'),
                'review' => GuestBookValidator::checkNotEmpty('review')
            ];

            $_SESSION['form_validity'] = $formValidity;

            $isIncorrectExists = array_search(false, $formValidity);

            if (!$isIncorrectExists) {
                saveReview([
                    'fio' => $_POST['fio'],
                    'email' => $_POST['email'],
                    'review' => $_POST['review']
                ]);
            }

            $_POST = [];

            $reviews = readReviews();

            include 'app/views/pages/guestbook.php';
        }

        public static function loadReviewsFromFile() {
            session_unset();
            saveReviewsFromFile();
            $reviews = readReviews();
            include 'app/views/pages/guestbook.php';
        }
    }
?>