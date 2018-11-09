<?php
    require_once 'framework/core/BaseActiveRecord.class.php';

    class TestModel extends BaseActiveRecord {
        protected $tableName = 'exam';
        public static $table = 'exam';
        protected $fields = ['id', 'date', 'fio', 'answers', 'is_correct'];
    }
?>