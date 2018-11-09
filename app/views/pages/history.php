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
                <section id="story">
                    <div class="history-table">
                        <p class="title">История за все время</p>
                        <table id="all-history">
                            <tr class="table-header">
                                <th>Название страницы</th>
                                <th>Кол-во посещений</th>
                            </tr>
                            <tr>
                                <td>Домашнаяя страница</td>
                                <td id="home">0</td>
                            </tr>
                            <tr>
                                <td>Обо мне</td>
                                <td id="about-me">0</td>
                            </tr>
                            <tr>
                                <td>Мои Интересы</td>
                                <td id="interestings">0</td>
                            </tr>
                            <tr>
                                <td>Учеба</td>
                                <td id="study">0</td>
                            </tr>
                            <tr>
                                <td>Альбом</td>
                                <td id="album">0</td>
                            </tr>
                            <tr>
                                <td>Контакты</td>
                                <td id="contacts">0</td>
                            </tr>
                            <tr>
                                <td>Тест</td>
                                <td id="test">0</td>
                            </tr>
                            <tr>
                                <td>История</td>
                                <td id="history">0</td>
                            </tr>
                        </table>
                    </div>
                    <div class="history-table">
                        <p class="title">История в текущей сессии</p>
                        <table id="session-history">
                            <tr class="table-header">
                                <th>Название страницы</th>
                                <th>Кол-во посещений</th>
                            </tr>
                            <tr>
                                <td>Домашнаяя страница</td>
                                <td id="home">0</td>
                            </tr>
                            <tr>
                                <td>Обо мне</td>
                                <td id="about-me">0</td>
                            </tr>
                            <tr>
                                <td>Мои Интересы</td>
                                <td id="interestings">0</td>
                            </tr>
                            <tr>
                                <td>Учеба</td>
                                <td id="study">0</td>
                            </tr>
                            <tr>
                                <td>Альбом</td>
                                <td id="album">0</td>
                            </tr>
                            <tr>
                                <td>Контакты</td>
                                <td id="contacts">0</td>
                            </tr>
                            <tr>
                                <td>Тест</td>
                                <td id="test">0</td>
                            </tr>
                            <tr>
                                <td>История</td>
                                <td id="history">0</td>
                            </tr>
                        </table>
                    </div>
                </section> 
            </section>
        </div>
        <div id="footer">
            <?php include 'app/views/includes/footer.php'; ?>
        <footer>
    </body>
</html>