<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<?php $sidebar_pos=get_theme_option('sidebar_position');
$main_add="";
    $sidebar_add="";
    if ($sidebar_pos=='left'){
        $main_add="col-md-10 order-md-2 order-1";
        $sidebar_add="order-md-1 order-2";
        $style_sidebar="pr-0 pl-3";
        $style_main="pl-2";
    }
    if ($sidebar_pos=='right'){
        $main_add="col-md-10 order-2";
        $sidebar_add="order-3";
        $style_sidebar="pl-0 pr-3";
        $style_main="pr-2";
    }
    if ($sidebar_pos=='none'){
        $main_add="col-md-12";
        $sidebar_add="";
        $style_main="";
    } ?>
    <?php 
    $size = 12;
    if ($sidebar_pos=='right'||$sidebar_pos=='left') {
        $size = 10;
    }
    ?>
<div class="container-fluid m-5">
<div class = "row">
<?php if ($sidebar_pos=='left' || $sidebar_pos=='right'): ?>
                    <div class="col-md-2 <?php echo $sidebar_add;?> <?php echo $style_sidebar;?>">
	<?php
$pageTree = exhibit_builder_page_tree();
if ($pageTree):
?>
<nav id="exhibit-pages">
    <?php echo $pageTree; ?>
</nav>
<?php endif; ?>
</div>
<?php endif; ?>
                <div class="<?php echo $main_add;?> <?php echo $style_main;?>">
<h1><?php echo metadata('exhibit', 'title'); ?></h1>
<?php echo exhibit_builder_page_nav(); ?>

<div id="primary">
<?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
<div class="exhibit-description">
    <?php echo $exhibitDescription; ?>
</div>
<?php endif; ?>

<?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
<div class="exhibit-credits">
    <h3><?php echo __('Credits'); ?></h3>
    <p><?php echo $exhibitCredits; ?></p>
</div>
<?php endif; ?>
</div>
</div>
</div>
</div>
<?php if ($sidebar_pos!='left' && $sidebar_pos!='right'): ?>
<?php
$pageTree = exhibit_builder_page_tree();
if ($pageTree):
?>
<nav id="exhibit-pages">
    <?php echo $pageTree; ?>
</nav>
<?php endif; ?>
<?php endif; ?>


<?php echo foot(); ?>
