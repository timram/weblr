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
                <h2 class="page-nav-title">Мои интересы:</h2>
                <?php
                    $interestingsConfig = $_SESSION['interestings_config'];
                    foreach ($interestingsConfig as $interesting) {
                        echo
                        '<section>'
                           .'<div class="section-container">'
                                .'<header>' . $interesting['title'] . '</header>'
                                .'<div class="my-data-container">'
                                    .'<div class="my-data text"><div class="data-description">'
                                        .'<p>' . $interesting['description'] . '</p>'
                                    .'</div></div>'
                                    .'<div class="my-data picture">'
                                        .'<img src="' . $interesting['imgUrl'] . '">'
                                    .'</div>'
                                .'</div>'
                           .'</div>'
                        .'</section>';
                    }
                ?>
            </section>
        </div>
        <div id="footer">
            <?php include 'app/views/includes/footer.php'; ?>
        <footer>
    </body>
</html>