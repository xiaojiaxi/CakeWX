<?php
	
	// echo '<pre>'; print_r($vmenu);
	
	// nav
	$this->start('nav');
	echo $this->element('nav');;
	$this->end();
?>

<?= $this->fetch('nav'); ?>
<div class="main-container" id="main-container">
	<div class="main-container-inner">
		<div class="page-content">
			<?php echo $this->fetch('content'); ?>
		</div><!-- /.page-content -->
		<?php echo $this->element('settings'); ?>
	</div><!-- /.main-container-inner -->
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="icon-double-angle-up icon-only bigger-110"></i>
	</a>
</div><!-- /.main-container 
</div><!-- /.main-container -->