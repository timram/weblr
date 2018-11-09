<?php
    require_once 'app/models/TestModel.class.php';
    require_once 'app/controllers/TestPage.class.php';
?>

<!doctype html>
<html> 
    <head>
        <?php include 'app/views/includes/head.php'; ?>
    </head>
    <body>
        <div id="main-content">
            <div class="navigation-container full-width">
                <?php include 'app/views/includes/header.php'; ?>
            </div>
            <section id="content" class="full-width">
                <div id="test-results">
                    <h2 class="title">Результаты</h2>
                    <div class="test-results-wrrapper">
                    <?php
                        $limit = TestPage::$limit;
                        $postsCount = TestModel::getRecordsCount();
                        $pageCount = ceil($postsCount / $limit);
                        $currPage = $offset > $pageCount ? $pageCount : $offset;
                        $records = TestModel::getRecords(($currPage - 1) * $limit, $limit, ['field' => 'date', 'direction' => 'desc']);

                        $optionToNameMapping = [
                            'q2-option' => 'Альтернативное название метода бисекций: ',
                            'q3-option' => 'Абсолютная погрешность равенства 1/3 = 0.33: ',
                            'q1-options' => 'Методы решения слау делятся на: ',
                            'q4-option' => 'Частный случай метода хорд: '
                        ];

                        function mapValue($value) {
                            if (is_array($value)) {
                                return join(', ', $value);
                            }
                            return $value;
                        }

                        echo '<div class="test-results-container">';
                        foreach($records as $record) {
                            $res = $record->get();
                            $isCorrect = (int)$res['is_correct'] == 1;
                            $answers = json_decode($res['answers'], true);
                            echo '<div class="blog-post">';
                            echo '<p>ФИО: ' . $res['fio'] . '</p>';
                            echo '<p>Ответы:</p>';
                            foreach($answers as $key => $value) {
                                echo '<p>' . $optionToNameMapping[$key] . mapValue($value) .  '</p>';
                            }
                            echo '<p>Дата: ' . $res['date'] . '</p>';
                            echo '<p>Результаты: ' . ($isCorrect ? 'Верно' : 'Не верно') . '</p>';
                            echo '</div>';
                        }
                        echo '</div>';

                        echo '<div class="pagination-wrapper">';
                        
                        if ($currPage > 1) {
                            echo '<a class="pagination-button" href="/test-results?offset=' . ($currPage - 1) . '"><</a>';
                        }
 
                        $leftPage = ($currPage - 2) < 1 ? 1 : ($currPage - 2);
                        $rightPage = ($currPage + 2) > $pageCount ? $pageCount : ($currPage + 2);
                        
                        for($i = $leftPage; $i <= $rightPage; $i++) {
                            if ($i != $currPage) {
                                echo '<a class="pagination-button" href="/test-results?offset=' . $i . '">' . $i . '</a>';
                            } else {
                                echo '<a class="pagination-button">' . $i . '</a>';
                            }
                            
                        }

                        if ($currPage < $pageCount) {
                            echo '<a class="pagination-button" href="/test-results?offset=' . ($currPage + 1) . '">></a>';
                        }

                        echo '</div>';
                    ?>
                    </div>
                </div>
            </section>
        </div>
        <div id="footer">
            <?php include 'app/views/includes/footer.php'; ?>
        <footer>
    </body>
</html>