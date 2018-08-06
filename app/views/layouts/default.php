<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<?=$this->getMeta();?>
</head>

<body>
<header>
	<div class="center-block-main">
		<h1 class="logo"><a href="/">DCTest-case(Home)</a></h1>
		<nav>
			<ul class="menu">
				<li><a href="/main/max">TOP500(max)</a></li>
				<li><a href="/main/lastyear">TOP500(last year)</a></li>
				<li><a href="/main/threemonth">TOP500(three month)</a></li>
			</ul>
		</nav>
	</div>
</header>
<div class="center-block-main content">
	<main>
		<?=$content;?>
	</main>
</div>
<footer>
	<div class="center-block-main">
		<p>Copyright &copy; 2018 dctest-case.loc - All right reserved - Find more Templates</p>
	</div>
</footer>

<!-- alert modal -->
<div id="myModal" class="modal-alert">
	<!-- Modal content -->
	<div class="alert-content">
		<div class="alert-header">
			<!--span class="alert-close" onclick="closeAlert()">&times;</span-->
			<h3>Внимание!</h3>
		</div>
		<div class="alert-body">
			<p>Непредвиденная ошибка</p>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/js/main.js"></script>

<?php if (DEBUG):?>
    <div class="debuger">
        <?php
			debug(\framework\base\Model::debugger());
        ?>
    </div>
<?php endif;?>
</body>
</html>
