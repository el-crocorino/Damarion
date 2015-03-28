<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="damarion.css" rel="stylesheet" />
        <title>Damarion - Home</title>
    </head>
    <body>
        <header>
            <h1>Damarion</h1>
        </header>

           <article>
                <h2>Question <?php echo $question->get_id(); ?> : <?php echo $question->get_text(); ?></h2>

                <?php
                    foreach ($answers AS $key => $answer) {
                ?>
                        <p><?php echo $answer->get_text(); ?></p>
                <?php
                    }
                ?>
            </article>

            <?php
                /*var_dump($games);
                var_dump($users);
                var_dump($votes);*/
            ?>

        <footer class="footer">
            <a href="#">Damarion</a>.
        </footer>
    </body>
</html>
