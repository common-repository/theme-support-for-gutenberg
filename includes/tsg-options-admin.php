<?php
// ======================================================== options admin ===============================
function tsg_opts_admin() {
?>
    <h2 style="color:blue;">Theme Support Options</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="tsg_save_options" value="Filter Options Saved" />
        <input style="display:none;" type="submit" name="atw_stop_enter" value="Ignore Enter"/>

<?php

    tsg_define_display();            // define content display options
    tsg_save_options_button();

    tsg_nonce_field('tsg_save_options');

?>

    </form>
    <hr />
<?php
}

function tsg_save_options_button() {
?>
<input style="margin-bottom:5px;" class="button-primary" type="submit" name="tsg_save_options" value="Save Options"/>
<?php
}


// ========================================= >>> tsg_define_display <<< ===============================

function tsg_define_display() {
    // define display filter options
?>

    <h3><u>Options for better integration with some themes</u></h3>
    <div class="wvrx-opts-section">
    <div class="wvrx-opts-title">&bull; Wide and Full Width <span class="wvrx-opts-title-description">Tweak support for Wide and Full width blocks.</span></div>

    <div class="wvrx-opts-opts">
<?php
        tsg_opt_checkbox('no_fitvids','Disable "fitvids" support. Will default to standard content width for videos if disabled.');
        tsg_opt_checkbox('have_flexible_video','My theme or site already has "fitvids" or equivalent responsive video support. Wide and Full video will be supported.');

        tsg_opt_checkbox('reduced_full_width','Leave a small margin for full aligned images. May improve display for some themes.','');
?>
    </div>

    <div style="clear:both;"></div>

	<div class="wvrx-opts-title">&bull; Legacy Editor Style</div>
	<div class="wvrx-opts-opts">
<?php
        tsg_opt_checkbox('no_load_edit_style',"Don't load theme's legacy editor styling. Usually legacy editor styling improves Gutenberg styling, but may cause issues.");
?>
    </div>
</div>
<?php
}

?>
