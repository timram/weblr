<?php
    require_once 'framework/core/BaseActiveRecord.class.php';

    class Blog extends BaseActiveRecord {
        protected $tableName = 'blog';
        public static $table = 'blog';
        protected $fields = ['id', 'subject', 'text', 'date', 'path_to_image'];
    }
?>