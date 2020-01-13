<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') 
{
	?>


	<section id="sidebar">
		<div class="inner">
			<nav>
				<ul>
					<li><a href="../public/index.php">Retour</a></li>
				</ul>
			</nav>
		</div>
	</section>

	<div id="wrapper">

		<!-- Intro -->
		<section id="intro" class="wrapper style1 fullscreen fade-up">
			<div class="inner">
				<?php
				$chars = preg_split('#/#', $target);
				$answer = $chars[1];
				?>
				<h1><?= $answer ?></h1>
				<video controls preload="auto" autoplay src="../video/<?= $target ?>" width="100%"></video>

			</div>
		</section>
	</div>



	<?php
}


?>






