<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />
	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="topnav">
		<div class="topnav_text">
			<a href="<?php echo $this->createUrl("site/index");?>">Home</a>&nbsp;|&nbsp;
			
			<?php if(Yii::app()->user->isGuest):?>
			<a href="<?php echo $this->createUrl("site/login");?>">Member's Login</a>&nbsp;|&nbsp;
			<a href="<?php echo $this->createUrl("site/register");?>">Sign Up</a> 
			<?php else:?>
			<a href="<?php echo $this->createUrl("publication/tag");?>">My Library</a>&nbsp;|&nbsp;
			<a href="<?php echo $this->createUrl("site/logout");?>">Logout&nbsp;(<?php echo Yii::app()->user->name;?>)</a> 
			<?php endif;?>
			
		</div>
	</div>
	
	<div id="header">
		<div id="logo" style="color: white; font-size: 20px; font-weight: bold;">
			<!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"/>-->
			<?php echo CHtml::encode(Yii::app()->name); ?>
		</div>
	</div><!-- header -->
    <!--
<?php /*$this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'test')),
                array('label'=>'Theme Pages',
                  'items'=>array(
                    array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs'),'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Form Elements', 'url'=>array('/site/page', 'view'=>'forms')),
					array('label'=>'Interface Elements', 'url'=>array('/site/page', 'view'=>'interface')),
					array('label'=>'Error Pages', 'url'=>array('/site/page', 'view'=>'Demo 404 page')),
					array('label'=>'Calendar', 'url'=>array('/site/page', 'view'=>'calendar')),
					array('label'=>'Buttons & Icons', 'url'=>array('/site/page', 'view'=>'buttons_and_icons')),
                  ),
                ),
                array('label'=>'Gii Generated Module',
                  'items'=>array(
                    array('label'=>'Items', 'url'=>array('/theme/index')),
                    array('label'=>'Create Item', 'url'=>array('/theme/create')),
					array('label'=>'Manage Items', 'url'=>array('/theme/admin')),
                  ),
                ),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
    )); */?> --->
	<div id="nav-container">
    	<div id="nav-bar">
		<?php 
		$items=array();
		
		if(Yii::app()->user->isGuest || Yii::app()->user->name='demo'){
			$links=array(array('label'=>'Publication Directory', 'url'=>array('publication/index')));
		} else{
			$links=array(array('label'=>'Publications', 'url'=>array('publication/index')),
						 array('label'=>'Users', 'url'=>array('user/index')),
						 array('label'=>'Departments', 'url'=>array('department/index')));
		}
		$items=array_merge($links);
		
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$items,
			'htmlOptions'=>array('id'=>'nav')
		)); ?>
		</div>
	</div> <!--mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Research and Development Office<br/>
		<small>LORMA COLLEGES, City of San Fernando, La Union</small><br/>
		<a href="http://lorma.edu/research-and-faculty-development/" target="_blank">About Us</a>&nbsp;|&nbsp;<a href="<?php echo $this->createUrl('site/contact');?>">Report Bugs</a>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>