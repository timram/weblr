<?php
    include 'framework/helpers/ShowError.class.php';
    require_once 'app/models/Blog.class.php';
    require_once 'app/controllers/BlogPage.class.php';
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
                    <form enctype="multipart/form-data" class="blog-form" method="POST" action="/blog">
                        <div class="input-container">
                            <label for="file">Картинка поста</label>
                            <input enctype="multipart/form-data" type="file" accept=".jpg, .jpeg, .png" id="blog-image" name="blog-image">
                        </div>
                        <div class="input-container">
                            <label for="subject">Тема поста</label>
                            <input  minlength="1" type="text" id="subject" name="subject">
                            <?php
                                ShowError::show('subject', 'Введите тему сообщения')
                            ?>
                        </div>
                        <div class="input-container">
                            <label for="message">Тело поста</label>
                            <textarea class="invalid" id="text" name="text" style="height:200px"></textarea>
                            <?php
                                ShowError::show('text', 'Введите пост')
                            ?>
                        </div>
                        <input type="submit" value="Отправить"  >
                        <input type="reset" value="Отчистить">
                    </form>
                    </div>
                    <div class="blog-column big">
                        <h2 class="title">Посты</h2>
                        <div class="blog-wrrapper">
                        <?php
                            $limit = BlogPage::$limit;
                            $postsCount = Blog::getRecordsCount();
                            $pageCount = ceil($postsCount / $limit);
                            $currPage = $offset > $pageCount ? $pageCount : $offset;

                            $postsRecords = Blog::getRecords(
                                ($currPage - 1) * $limit,
                                $limit,
                                ['field' => 'date', 'direction' => 'desc']
                            );

                            echo '<div class="blog-container">';
                            foreach($postsRecords as $record) {
                                $post = $record->get();
                                echo '<div class="blog-post">';
                                if (isset($post['path_to_image'])) {
                                    echo '<img src="' . $post['path_to_image'] . '">';    
                                }
                                echo '<h2>' . $post['subject'] . '</h2>';
                                echo '<p>' . $post['text'] . '</p>';
                                echo '</div>';
                            }
                            echo '</div>';

                            echo '<div class="pagination-wrapper">';
                            
                            if ($currPage > 1) {
                                echo '<a class="pagination-button" href="/blog?offset=' . ($currPage - 1) . '"><</a>';
                            }

                            $leftPage = ($currPage - 2) < 1 ? 1 : ($currPage - 2);
                            $rightPage = ($currPage + 2) > $pageCount ? $pageCount : ($currPage + 2);
                            
                            for($i = $leftPage; $i <= $rightPage; $i++) {
                                if ($i != $currPage) {
                                    echo '<a class="pagination-button" href="/blog?offset=' . $i . '">' . $i . '</a>';
                                } else {
                                    echo '<a class="pagination-button">' . $i . '</a>';
                                }
                                
                            }

                            if ($currPage < $pageCount) {
                                echo '<a class="pagination-button" href="/blog?offset=' . ($currPage + 1) . '">></a>';
                            }

                            echo '</div>';
                        ?>
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