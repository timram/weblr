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
                    <div class="gallery">
                    <?php
                        $imagesConfig = $_SESSION['images_config'];
                        $size = sizeof($imagesConfig);
                        for ($i = 0; $i < $size; $i++) {
                            echo '<div class="img-wrap">'
                                . '<img data-id="' . $i . '" class="album-image" src=' . $imagesConfig[$i]['image'] . '>'
                                . '<span class="img-description">' . $imagesConfig[$i]['title'] . '</span>'
                                . '<div class="pop-up-description">' . $imagesConfig[$i]['description'] . '</div>'
                                . '</div>';
                        }
                    ?>
                    </div>
                    <div class="image-full-view"  style="display: none;">
                        <div class="carousel-container">
                            <div class="counter">
                                <span class="curr">0</span>/<span class="total">0</span>
                            </div>
                            <div class="carousel">
                                <div class="toggle prev">
                                    <span class="arrow left"></span>
                                </div>
                                <ul>
                                <?php
                                    $imagesConfig = $_SESSION['images_config'];
                                    foreach ($imagesConfig as $image) {
                                        echo '<li>' . '<img src=' . $image['image'] . '>' . '</li>';
                                    }
                                ?>          
                                </ul>
                                <div class="toggle next">
                                    <span class="arrow right"></span>
                                </div>
                            </div>
                            <div class="image-title">
                                <p>asdfasd asdfasdf</p>
                            </div>
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