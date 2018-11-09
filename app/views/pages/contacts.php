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
                    <h1 class="title">Мои контакты:</h1>
                </header>
                <div class="my-data-container">
                    <div class="my-data">
                        <div class="data-description">
                            <p>ФИО: Рамазанов Тимур Рашидович</p>
                            <p>Телефон: <a href="tel:+79780652008">+7(978)065-20-08</a></p>
                            <p>Почта:
                                <a href="mailto:rjckec@gmail.com">rjckec@gmail.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="my-data">
                        <p class="title">Свяжитесь со мной</p>
                        <form class="contact-form" method="POST" action="/contacts">
                            <lable for="dob">Дата рождения</lable>
                            <input type="date" id="dob" name="dob" min="1950-01-01" value="2018-01-01" required="required">
                            <div class="calendar-container">
                                <div class="calendar hidden">
                                    <div class="calendar-header">
                                        <select name="month">
                                            <option value="01">Январь</option>
                                            <option value="02">Февраль</option>
                                            <option value="03">Март</option>
                                            <option value="04">Апрель</option>
                                            <option value="05">Май</option>
                                            <option value="06">Июнь</option>
                                            <option value="07">Июль</opction>
                                            <option value="08">Август</option>
                                            <option value="09">Сентябрь</option>
                                            <option value="10">Октябрь</option>
                                            <option value="11">Ноябрь</option>
                                            <option value="12">Декабрь</option>
                                        </select>
                                        <select name="year">
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                            <option value="1989">1989</option>
                                            <option value="1988">1988</option>
                                            <option value="1987">1987</option>
                                            <option value="1986">1986</option>
                                            <option value="1985">1985</option>
                                            <option value="1984">1984</option>
                                            <option value="1983">1983</option>
                                            <option value="1982">1982</option>
                                            <option value="1981">1981</option>
                                            <option value="1980">1980</option>
                                            <option value="1979">1979</option>
                                            <option value="1978">1978</option>
                                            <option value="1977">1977</option>
                                            <option value="1976">1976</option>
                                            <option value="1975">1975</option>
                                            <option value="1974">1974</option>
                                            <option value="1973">1973</option>
                                            <option value="1972">1972</option>
                                            <option value="1971">1971</option>
                                            <option value="1970">1970</option>
                                            <option value="1969">1969</option>
                                            <option value="1968">1968</option>
                                            <option value="1967">1967</option>
                                            <option value="1966">1966</option>
                                            <option value="1965">1965</option>
                                            <option value="1964">1964</option>
                                            <option value="1963">1963</option>
                                            <option value="1962">1962</option>
                                            <option value="1961">1961</option>
                                            <option value="1960">1960</option>
                                            <option value="1959">1959</option>
                                            <option value="1958">1958</option>
                                            <option value="1957">1957</option>
                                            <option value="1956">1956</option>
                                            <option value="1955">1955</option>
                                            <option value="1954">1954</option>
                                            <option value="1953">1953</option>
                                            <option value="1952">1952</option>
                                            <option value="1951">1951</option>
                                            <option value="1950">1950</option>
                                        </select>
                                    </div>
                                    <div class="calendar-week-days">
                                        <div class="calendar-option week-day">ПН</div>
                                        <div class="calendar-option week-day">ВТ</div>
                                        <div class="calendar-option week-day">СР</div>
                                        <div class="calendar-option week-day">ЧТ</div>
                                        <div class="calendar-option week-day">ПТ</div>
                                        <div class="calendar-option week-day">СБ</div>
                                        <div class="calendar-option week-day">ВС</div>
                                    </div>
                                    <div class="calendar-options-container">
                                    </div>
                                </div>
                            </div>
                            <div class="input-container">
                                <label for="fio">ФИО (обязательно к заполнению)</label>
                                <input class="invalid" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['fio'] : ''?>" minlength="1" type="text" id="fio" name="fio" placeholder="Иванов Иван Иванович">
                                <?php
                                    ShowError::show('fio', 'Введите ФИО зарегистрированного пользователя')
                                ?>
                            </div>
                            <div class="input-container">
                                <label for="phone">Телефон (обязательно к заполнению)</label>
                                <input value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['phone'] : ''?>" class="invalid" type="text" id="phone" name="phone" placeholder="+79781234567">
                                <?php
                                    ShowError::show('phone', 'Некоректное номер телефона')
                                ?>
                            </div>
                            <label for="city">Город</label>
                            <select id="city" name="city">
                                <option value="симферополь">Симферополь</option>
                                <option value="севастополь">Севастополь</option>
                                <option value="ялта">Ялт    а</option>
                            </select>
                            <div class="input-container">
                                <label for="subject">Тема (обязательно к заполнению)</label>
                                <input class="invalid" minlength="1" type="text" id="subject" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['subject'] : ''?>" name="subject" placeholder="Тема сообщения">
                                <?php
                                    ShowError::show('subject', 'Введите тему')
                                ?>
                            </div>
                            <div class="input-container">
                                <label for="mail">Почта (обязательно к заполнению)</label>
                                <input class="invalid" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['mail'] : ''?>" minlength="1" type="email" id="mail" name="mail" placeholder="example@mail.com">
                                <?php
                                    ShowError::show('email', 'Некоректная почта')
                                ?>
                            </div>
                            <div class="input-container">
                                <label for="message">Сообщение (обязательно к заполнению)</label>
                                <textarea class="invalid" id="message" name="message" placeholder="Сообщение..." style="height:200px"><?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['message'] : ''?></textarea>
                                <?php
                                    ShowError::show('message', 'Введите сообщение')
                                ?>
                            </div>
                            <input type="submit" value="Отправить"  >
                            <input type="reset" value="Отчистить">
                        </form>
                    </div>
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