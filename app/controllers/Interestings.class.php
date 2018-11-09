<?php

class Interestings {
    public static function getPage() {
        $_SESSION['interestings_config'] = array(
            array(
                'title' => 'web',
                'description' => 'Слежу за последними обновлениями мира WEB в частности HTML5, CSS3, ES6+ '
                    . 'Интересуюсь JavaScript в том числе и разрабткой серверных приложений на NodeJS '
                    . 'Так же интересуюсь компилируемыми в JavaScript Языками программирования в частности TypeScript',
                'imgUrl' => 'public/img/web.png'    
            ),
            array(
                'title' => 'Базы данных',
                'description' => 'Интересуюсь реляционными базами даннаыми в частности СУБД поддерживающим реляционную модель: PostgreSQL, MySQL '
                    . 'Так же интересуюсь документно ориентированными базами данных: MongoDB',
                'imgUrl' => 'public/img/db.png'    
            ),
            array(
                'title' => 'Музыка',
                'description' => 'Слушаю музыку, вот, крутую, вот '
                    . 'играю на гитарке',
                'imgUrl' => 'public/img/music.png'    
            )
        );
        include 'app/views/pages/interestings.php';
    }
}

?>