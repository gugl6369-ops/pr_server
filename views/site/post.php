<h1>Список статей</h1>
<ol>
    <?php
    foreach ($posts ?? [] as $post) {
        echo '<li class="post_li">' . $post->title . '</li>';
    }
    ?>
</ol>