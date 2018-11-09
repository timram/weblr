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
                <section>
                    <div class="my-data-container">
                        <div class="my-data text">
                            <p>Я студент...</p>
                            <div class="data-description">
                                Кафедры информационных систем Севастопольского Государственного Университета
                            </div>
                        </div>
                        <div class="my-data picture">
                            <img alt="sutdent" src="public/img/student.jpg">
                        </div>
                    </div>
                    <div class="my-data-container">
                        <div class="my-data picture">
                            <img alt="music" src="public/img/music.jpg">
                        </div>
                        <div class="my-data text">
                            <p>...Слушаю музыку</p>
                            <div class="data-description">
                                Всякую крутяцкую музыку слушаю
                            </div>
                        </div>
                    </div>
                    <div class="my-data-container">
                        <div class="my-data text">
                            <p>И еще много чего делаю...</p>
                        </div>
                        <div class="my-data picture">
                            <img alt="trash" src="public/img/trash.jpg">
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <div id="footer">
            <?php include 'app/views/includes/footer.php'; ?>
        <footer>
    </body>
</html>