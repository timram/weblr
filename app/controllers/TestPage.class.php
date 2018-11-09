<?php
require_once 'app/validators/TestValidator.class.php';
require_once 'app/models/TestModel.class.php';
function isValidUser($formValidity) {
    return $formValidity['fio'] && $formValidity['mail'] && $formValidity['group'];
}

function getAnswers() {
    $options = ['q1-options', 'q2-option', 'q3-option', 'q4-option'];
    $answers = [];
    for ($i = 0; $i < sizeof($options); $i++) {
        $key = $options[$i];
        if (isset($_POST[$key])) {
            $answers[$key] = $_POST[$key];
        }
    }

    return $answers;
    // return json_encode($answers);
}

function isFormValid($formValidity) {
    if (array_search(false, $formValidity)) {
        return 0;
    }
    return 1;
}

class TestPage {
    private static $limit = 5;

    public static function getPage() {
        session_unset();
        include 'app/views/pages/test.php';
    }

    public static function validateForm() {
        $formValidity = array(
            'fio' => TestValidator::checkFIO('fio'),
            'mail' => TestValidator::checkMail('mail'),
            'group' => TestValidator::checkGroup('group'),
            'q3-option' => TestValidator::checkSingleOption('q3-option', '10'),
            'q1-option' => TestValidator::checkMultipleOptions('q1-options', array('b', 'c')),
            'q4-option' => TestValidator::checkSingleOption('q4-option', 'c'),
            'q2-option' => TestValidator::checkSingleOption('q2-option', 'b')
        );

        $_SESSION['form_validity'] = $formValidity;

        if (isValidUser($formValidity)) {
            $testResults = new TestModel([
                'fio' => $_POST['fio'],
                'is_correct' => isFormValid($formValidity),
                'answers' => getAnswers()
            ]);

            $testResults->save();
        }

        include 'app/views/pages/test.php';
    }

    public static function viewResults() {
        session_unset();

        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 1;

        $offset = $offset < 1 ? 1 : $offset;

        include 'app/views/pages/test_results.php';
    }
}

?> 