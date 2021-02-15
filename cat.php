<?php
require 'config.php';
require 'inc/session.php';
require 'inc/categories_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 15;

if(!isset($_GET['id']))
	header('Location: categories.php');
$cat = $_cats->get_cat($_GET['id']);
if(!$cat->id)
	header('Location: categories.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<?php require 'inc/head.php'; ?>
</head>
<body style="direction: rtl;text-align:right;">
	<div id="main-wrapper" style="direction: rtl;text-align:right;">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad" style="direction: rtl;text-align:right;">
			<h2>مشخصات دسته بندی</h2>
			<div class="center">
				<div class="new-cat form">
					شماره دسته بندی:<br />
					<div class="ni-cont light">
						<?php echo $cat->id; ?><br /><br />
					</div>
					نام دسته بندی:<br />
					<div class="ni-cont light">
						<?php echo $cat->name; ?><br /><br />
					</div>
					مکان دسته بندی:<br />
					<div class="ni-cont light">
						<?php echo $cat->place; ?><br /><br />
					</div>
					<span class="ncat-desc-left">اطلاعات دسته بندی</span>
					<div class="ni-cont light">
						<?php echo $cat->descrp; ?><br /><br />
					</div>
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
	</div>
</body>
</html>