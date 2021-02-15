<?php
$headrole = $_session->get_user_role();
if($headrole == 1)
	$as = 'مدیر زیرساخت';
elseif($headrole == 2)
	$as = 'هلپ دسک';
elseif($headrole == 3)
	$as = 'رابط';
elseif($headrole == 4)
	$as = 'انباردار';
?>
<div id="header">
			<div class="left">
				<a href="home.php"><img src="media/img/logo3x.png" width="150" height="50" alt="Invento" /></a>
				<div style="font-size:12px; font-style:italic;color:#bbb;"><?php echo $as; ?></div>
			</div>
			<div class="right">
				<?php
				if($headrole == 1 || $headrole == 2 || $headrole == 3)
					echo '<a href="users.php" title="Users">کاربران</a>|';
				?>
				<a href="settings.php" title="Settings">تنظیمات</a>|
				<a href="logout.php" title="Logout">خروج</a>
			</div>
			<div class="clear"></div>
		</div>
		
		<input type="checkbox" class="toggle" id="opmenu" style="display:none"/>
		<label for="opmenu" id="open-menu"><i class="fa fa-align-justify"></i> Menu</label>
		<div id="menu">
			<ul id="menuli">
				<?php
				// Home only for Admin and General Supervisor (Stats)
				if($headrole == 1 || $headrole == 2 || $headrole == 3 || $headrole == 4) {
				?>
					<li<?php if($_page == 1) { ?> class="active"<?php } ?>><a href="home.php"><i class="fa fa-home"></i> صفحه اصلی</a></li>
				<?php
				}
				?>
				
				<?php
				if($headrole == 1 || $headrole == 2 || $headrole == 3){
				 ?>
					<!-- <li<?php if($_page == 2) { ?> class="active"<?php } ?>><a href="new-item.php"> سیستم جدید <i class="fa fa-plus"></i></a></li> -->
				<?php
				}
				?>
				<?php
				if($headrole == 1 || $headrole == 2 || $headrole == 3){
				// ?>
				<li<?php if($_page == 3) { ?> class="active"<?php } ?>><a href="items.php"><i class="fa fa-list-ul"></i> سیستم ها  </a></li>
				<?php
				}
				?>
				<li<?php if($_page == 4) { ?> class="active"<?php } ?>><a href="anbar.php" title="انبار"><i class="fa fa-arrow-down"></i>انبار</a></li>
				<li<?php if($_page == 5) { ?> class="active"<?php } ?>><a href="check-out.php"><i class="fa fa-arrow-up"></i> Check-Out Item</a></li>
				
				<?php
				if($headrole == 1){
				?>
					<li<?php if($_page == 6) { ?> class="active"<?php } ?>><a href="logs.php" ><i class="fa fa-file-text-o"></i> گزارش ها</a></li>
				<?php
				}
				?>
				<?php
				if($headrole == 1){
				?>
				<li<?php if($_page == 7) { ?> class="active"<?php } ?>><a href="categories.php" ><i class="fa fa-folder"></i> دسته بندی ها</a></li>
				<?php
				}
				?>
			</ul>
		</div>