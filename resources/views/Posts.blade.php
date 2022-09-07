<!DOCTYPE html>

<title>My Blog</title>
<link rel="stylesheet" href="/app.css">

<body> 
   

    <?php foreach($Posts as $Post) : ?>
        <!-- <?php var_dump($Post);?>  -->
        <article>

            <h1>
                <a href="/Posts/<?= $Post -> id ?>">
                    
                    <?= $Post -> Title; ?>
            
                </a>
            
            </h1>
            
            <div>

                <?= $Post -> Body; ?>
            
            </div>

        </article>

    <?php endforeach; ?>


</body>

</html>