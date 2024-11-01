<?php
// ======================================================== options admin ===============================
function tsg_opts_admin() {
?>
    <h2 style="color:blue;">Generic Options</h2>
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

    <h3><u>Define Some Generic Options</u></h3>
    <div class="wvrx-opts-section">
    <div class="wvrx-opts-title">&bull; Post Display <span class="wvrx-opts-title-description">When displaying posts, use these display options. Don't apply to image sliders.</span></div>

    <div class="wvrx-opts-opts">
<?php
        tsg_opt_checkbox('hide_title','Hide Post Title','');
        tsg_opt_checkbox('show_avatar','Show Author Avatar');

        tsg_opt_checkbox('hide_top_info','Hide Top Post Meta Info (date, author)','');
        tsg_opt_checkbox('hide_bottom_info','Hide Bottom Post Meta Info (category, tag, comment link)');

        tsg_opt_checkbox('hide_featured_image','Hide Featurd Image in post (default: show; or theme defaults)', '');

        echo '<br />';
        tsg_opt_textarea('more_msg','"Continue Reading..." message for excerpts.');

        $cur_show = tsg_getopt('show');
?>


    <div style="padding:1em 0 .5em 4em;text-indent:-1.7em;">Display posts as: &nbsp;&nbsp;
	<select name="show">
	<option value="" <?php selected( $cur_show == '' );?>></option>
	<option value="full" <?php selected( $cur_show == 'full');?>>Full post</option>
	<option value="excerpt" <?php selected( $cur_show == 'excerpt');?>>Excerpt</option>
	<option value="title" <?php selected( $cur_show == 'title');?>>Title + Top Meta Line</option>
    <option value="titlelist" <?php selected( $cur_show == 'titlelist');?>>Title only as list</option>
    <option value="title_featured" <?php selected( $cur_show == 'title_featured');?>>Title + Featured Image</option>
	</select> &nbsp;How to display posts - (Default: full post; Weaver theme settings)
    </div>


    </div>

    <div style="clear:both;"></div>

        <div class="wvrx-opts-description">
    <p>
        A description goes here...
    </p>
    </div>
</div>
<?php
}

?>
