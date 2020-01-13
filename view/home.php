<section id="sidebar">
    <div class="inner">
        <nav>
            <ul>
             <?php
             if (!isset($_SESSION['name'])){
                ?>
                <li><a href="../public/index.php">Connexion</a></li>
                <?php
            }
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
            {
                ?>
                <li><a href="../public/index.php?route=logOut">Se deconnecter</a></li>
                <?php
            }
            ?>

        </ul>
    </nav>
</div>
</section>




<?php
if (!isset($_SESSION['name'])){
    ?>
    <div id="wrapper">
        <section id="intro" class="wrapper style1 fullscreen fade-up">
            <div class="inner">
                <h2>Connexion</h2>
                <p>Tentez votre chance!!</p>
                
                

                
                <form method="post" action="../public/index.php?route=logIn">
                    <div class="fields">
                        <div class="field">
                            <label for="name">pseudo(*)</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="field">
                            <label for="password">mot de passe(*)</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Connexion" id="submit" name="submit" /></li>
                    </ul>
                </form>

                
            </div>
        </section>
    </div>


    <?php
}
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
{              
    ?>
    <div id="wrapper">

        <!-- Intro -->
        <section id="intro" class="wrapper style1 fullscreen fade-up">
            <div class="inner">
                <h1>Stream by Ben</h1>
                <h2>Liste des videos</h2>
                

                <?php
                if (!empty($films)){
                    ?>
                    <h4>Film</h4>
                    <?php
                    foreach ($films as $film) 

                    {
                       ?>	
                       
                       <p><a href="../public/index.php?route=movie&idArt=film/<?= htmlspecialchars($film);?>"><?= $film?></a></p>
                       
                       <?php
                   }
               }
               ?>
               <br/> <h4>Hero Corp</h4>
               <?php

               foreach ($heroCorps as $heroCorp) 
               {
                ?>
                <p><a href="../public/index.php?route=movie&idArt=herocorp/<?= htmlspecialchars($heroCorp);?>"><?= $heroCorp?></a></p>
                <?php
            }
            ?>
            <br/> <h4>Documentaires</h4>
            <?php
            foreach ($docs as $doc) 
            {
                ?>
                <p><a href="../public/index.php?route=movie&idArt=doc/<?= htmlspecialchars($doc);?>"><?= $doc?></a></p>
                <?php
            }
            ?>
            <br/> <h4>Simpsons</h4>
            <?php
            foreach ($simpsons as $simpson) 
            {
                ?>
                <p><a href="../public/index.php?route=movie&idArt=simpson/<?= htmlspecialchars($simpson);?>"><?= $simpson?></a></p>
                <?php
            }
        }
        ?>

    </div>
</section>
</div>




