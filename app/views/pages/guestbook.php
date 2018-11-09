<?php
    include 'framework/helpers/ShowError.class.php';
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
                <div id="blog">
                    <div class="blog-column small">
                    <form class="blog-form" method="POST" action="/guestbook">
                        <div class="input-container">
                            <label for="fio">ФИО</label>
                            <input  minlength="1" type="text" id="fio" name="fio">
                            <?php
                                ShowError::show('fio', 'Введите корректное имя')
                            ?>
                        </div>
                        <div class="input-container">
                            <label for="email">Почта</label>
                            <input type="email" id="email" name="email">
                            <?php
                                ShowError::show('email', 'Введите корректную почту')
                            ?>
                        </div>
                        <div class="input-container">
                            <label for="message">Отзыв</label>
                            <textarea id="review" name="review" style="height:200px"></textarea>
                            <?php
                                ShowError::show('review', 'Введите отзыв')
                            ?>
                        </div>
                        <input type="submit" value="Отправить"  >
                        <input type="reset" value="Отчистить">
                    </form>
                    <form enctype="multipart/form-data" class="blog-form" method="POST" action="/guestbook-upload">
                        <div class="input-container">
                            <label for="file">Загрузить отзывы</label>
                            <input enctype="multipart/form-data" type="file" accept=".txt, .inc" id="uploadFile" name="uploadFile">
                        </div>
                        <input type="submit" value="Отправить"  >
                        <input type="reset" value="Отчистить">
                    </form>
                    </div>
                    <div class="blog-column big">
                        <h2 class="title">Отзывы</h2>
                        <div class="blog-wrrapper reviews">
                            <div class="schedule-table">
                                <table>
                                <tr class="table-header">
                                    <th>Имя</th>
                                    <th>Почта</th>
                                    <th>Отзыв</th>
                                    <th>Дата</th>
                                </tr>
                                <?php
                                    function drawData($data) {
                                        echo '<td>';
                                        echo $data;
                                        echo '</td>';
                                    }

                                    $reviewsCount = sizeof($reviews);
                                    for ($i = 0; $i < $reviewsCount; $i++) {
                                        echo '<tr>';
                                        drawData($reviews[$i]['name']);
                                        drawData($reviews[$i]['email']);
                                        drawData($reviews[$i]['review']);
                                        drawData($reviews[$i]['date']);
                                        echo '</tr>';
                                    }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="footer">
            <?php include 'app/views/includes/footer.php'; ?>
        <footer>
    </body>
</html>