<?php
 

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
    <div id="pagewrapper" >
<div id="page">

<!-- START OF HEADER -->

    <div id="page-header" class="clearfix">
		<div id="page-header-wrapper">
	        <h1 class="headermain"><img src="<?php echo $OUTPUT->pix_url('logo', 'theme')?>" alt="Custom logo here" /> </h1>
<!--                <h1 class="headermain"><?php echo $PAGE->heading ?></h1>-->
    	    <div class="headermenu">
        		<?php
	        	    echo $OUTPUT->login_info();
                                                echo $OUTPUT->lang_menu();
	        	    echo $PAGE->headingmenu;
                             if (isloggedin()) {
	        	     echo html_writer::tag('div', $OUTPUT->user_picture($USER, array('size'=>55)), array('class'=>'userimg'));
                                                      }
		        ?>
               	    	</div>
	    </div>
    </div>

    <?php if ($hascustommenu) { ?>

<!--<div id="custommenu">

<div id="menuright">
<div id="menuleft">
<?php //echo $custommenu; ?>
</div>
</div>
</div>-->
      <div id="custommenu"><?php echo $custommenu; ?> 
    <?php } else { ?>
      <ul id="page-navigation" class="clearfix">
        <li>&nbsp;</li>
      </ul>
  	<?php } ?>

<!-- END OF HEADER -->

<!-- START OF CONTENT -->

<div id="page-content-wrapper">
    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">

                <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                            <?php echo $OUTPUT->main_content() ?>
                        </div>
                    </div>
                </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div> 
                <?php } ?>

                <?php if ($hassidepost) { ?>
                <div id="region-post">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<!-- END OF CONTENT -->

<!-- START OF FOOTER -->

    <div id="page-footer" style="border-top:2px solid #CDCDCD;">
        <p class="helplink">
        <?php echo page_doc_link(get_string('moodledocslink')) ?>
        </p>

        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>

<!-- END OF FOOTER -->

</div>
        </div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
