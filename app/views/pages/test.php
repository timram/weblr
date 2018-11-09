<?php include 'framework/helpers/ShowError.class.php'; ?>
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
                <header>
                    <h1 class="title">Тест по дисциплине "Численные методы в информатике"</h1>
                </header>
                <div class="test-form-container">
                    <form class="test-form" method="POST" action="/test">
                        <div class="my-data-container">
                            <div class="my-data">
                                <div class="input-container">
                                    <label for="fio">ФИО (обязательно к заполнению)</label>
                                    <input class="invalid" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['fio'] : ''?>" type="text" id="fio" name="fio" placeholder="Иванов Иван Иванович">
                                    <?php
                                        ShowError::show('fio', 'Введите ФИО зарегетсрированного пользователя')
                                    ?>
                                </div>
                                <div class="input-container">
                                    <label for="mail">Почта (обязательно к заполнению)</label>
                                    <input class="ivalid" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['mail'] : ''?>" type="email" id="mail" name="mail" placeholder="example.com">
                                    <?php
                                        ShowError::show('mail', 'Некоректная почта')
                                    ?>
                                </div>
                                <label for="group">Группа</label>
                                <select id="group" name="group">
                                    <option value="исб-31-о">ИСб-31-о</option>
                                    <option value="исб-32-о">ИСб-32-о</option>
                                    <option value="исб-33-о">ИСб-33-о</option>
                                </select>
                                <?php
                                    ShowError::show('group', 'Студент не зарегестрирован в группе')
                                ?>
                                <a href="/test-results">Посмотреть все результаты</a>
                            </div>
                            <div class="my-data">
                                <div data-questionID=1 name="question1" class="test-unit multi_option invalid">
                                    <p class="title left">Методы решения СЛАУ делятся на</p>
                                    <div class="test-option">
                                        <input id="q1-option1" type="checkbox" name="q1-options[]" value="a">
                                        <label for="q1-option1">прямые и косвенные</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q1-option2" type="checkbox"  name="q1-options[]" value="b">
                                        <label for="q1-option2">начальные и конечные</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q1-option3" type="checkbox" name="q1-options[]" value="c">
                                        <label for="q1-option3">прямые и итерационные</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q1-option4" type="checkbox" name="q1-options[]" value="d">
                                        <label for="q1-option4">определенные и неопределенные</label>
                                    </div>
                                </div>
                                <?php
                                    ShowError::show('q1-option', 'Не верный ответ, попробуйте еще')
                                ?>
                                <div data-questionID=2 name="question2" class="test-unit single_option select">
                                    <p class="title left">У метода бисекций есть альтернативное название - это ...</p>
                                    <div class="test-option">
                                        <select id="q2-option" name="q2-option">
                                            <option value="a">метод хорд</option>
                                            <option value="b">метод пропорциональных частей</option>
                                            <option value="c">метод прогонки</option>
                                            <option value="d">метод половинного деления</option>
                                        </select>
                                    </div>
                                    <?php
                                        ShowError::show('q2-option', 'Не верный ответ, попробуйте еще')
                                    ?>
                                </div>
                                <div data-questionID=3 class="test-unit single_option text invalid">
                                    <p class="title left">Абсолютная погрешность равенства 1/3 = 0.33 (обязательно к заполнению)</p>
                                    <div class="test-option">
                                        <div class="input-container">
                                            <input value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['q3-option'] : ''?>" id="q3-option1" name="q3-option" type="text">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    ShowError::show('q3-option', 'Не верный ответ, попробуйте еще')
                                ?>
                                <div data-questionID=4 name="question4" class="test-unit multi_option radio invalid">
                                    <p class="title left">Метод хорд - это частный случай...</p>
                                    <div class="test-option">
                                        <input id="q4-option1" type="radio" name="q4-option" value="a">
                                        <label for="q4-option1">метода прогонки</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q4-option2" type="radio" name="q4-option" value="b">
                                        <label for="q4-option2">метода итераций</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q4-option3" type="radio" name="q4-option" value="c">
                                        <label for="q4-option3">метода Зейделя</label>
                                    </div>
                                    <div class="test-option">
                                        <input id="q4-option4" type="radio" name="q4-option" value="d">
                                        <label for="q4-option4">метода Гаусса</label>
                                    </div>
                                </div>
                                <?php
                                    ShowError::show('q4-option', 'не верный ответ, попробуйте еще')
                                ?>
                                <div class="test-buttons-container">
                                    <input type="submit" value="Отправить">
                                    <input type="reset" value="Отчистить">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="popup-accept-message-overlay">
                    <div class="popup-accept-message-container">
                        <p class="message">Do you really want to do this ?</p>
                        <div class="accept-buttons-container">
                            <button>Да</button>
                            <button>Нет</button>
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