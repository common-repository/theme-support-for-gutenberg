<?php

function tsg_help_link($ref, $label) {

    $t_dir = tsg_plugins_url('/help/' . $ref, '');
    $icon = tsg_plugins_url('/help/help.png','');
    $pp_help =  '<a href="' . $t_dir . '" target="_blank" title="' . $label . '">'
		. '<img class="entry-cat-img" src="' . $icon . '" style="position:relative; top:4px; padding-left:4px;" title="Click for help" alt="Click for help" /></a>';
    echo $pp_help ;
}


function tsg_save_msg($msg) {
    echo '<div id="message" class="updated fade" style="width:70%;"><p><strong>' . $msg .
	    '</strong></p></div>';
}

function tsg_error_msg($msg) {
    echo '<div id="message" class="updated fade" style="background:#F88;" style="width:70%;"><p><strong>' . $msg .
	    '</strong></p></div>';
}




/*
    ================= nonce helpers =====================
*/
function tsg_submitted($submit_name) {
    // do a nonce check for each form submit button
    // pairs 1:1 with aspen_nonce_field
    $nonce_act = $submit_name.'_act';
    $nonce_name = $submit_name.'_nonce';

    if (isset($_POST[$submit_name])) {
	if (isset($_POST[$nonce_name]) && wp_verify_nonce($_POST[$nonce_name],$nonce_act)) {
	    return true;
	} else {
	    die("WARNING: invalid form submit detected ($submit_name). Probably caused by session time-out, or, rarely, a failed security check. Please contact WeaverTheme.com if you continue to receive this message.");
	}
    } else {
	return false;
    }
}

function tsg_nonce_field($submit_name,$echo = true) {
    // pairs 1:1 with sumbitted
    // will be one for each form submit button

    return wp_nonce_field($submit_name.'_act',$submit_name.'_nonce',$echo);
}

/*
    ================= form helpers =====================
*/

function tsg_get_POST( $id ) {
    return isset( $_POST[$id]) ? stripslashes( $_POST[$id] ) : '';
}

// general values - tsg_getopt

function tsg_form_checkbox($id, $desc, $br = '<br />') {
?>
    <div style = "display:inline;padding-left:2.5em;text-indent:-1.7em;"><label><input type="checkbox" name="<?php echo $id ?>" id="<?php echo $id; ?>"
        <?php checked(tsg_getopt($id) ); ?> >&nbsp;
<?php   echo $desc . '</label></div>' . $br . "\n";
}

// filter values - tsg_getopts

function tsg_opt_checkbox($id, $desc, $br = '<br />') {
?>
    <div style = "display:inline;padding-left:2.5em;text-indent:-1.7em;"><label><input type="checkbox" name="<?php echo $id; ?>" id="<?php echo $id; ?>"
        <?php checked(tsg_getopt($id) ); ?> >&nbsp;
<?php   echo $desc . '</label></div>' . $br . "\n";
}

function tsg_opt_textarea($id, $desc, $br = '<br />') {
?>
    <div style="margin-top:5px;display:inline-block;padding-left:4em;text-indent:-1.7em;"><label>
    <textarea style="margin-bottom:-8px;" cols=32 rows=1 maxlength=64 name="<?php echo $id; ?>"><?php echo sanitize_text_field( tsg_getopt($id) ); ?></textarea>
    &nbsp;
<?php   echo $desc . '</label></div>' . $br . "\n";
}

function tsg_opt_val($id, $desc, $br = '<br />') {
?>
    <div style = "margin-top:5px;display:inline-block;padding-left:2.5em;text-indent:-1.7em;"><label>
    <input class="regular-text" type="text" style="width:50px;height:22px;" name="<?php echo $id; ?>" value="<?php echo sanitize_text_field( tsg_getopt($id) ); ?>" />
    &nbsp;
<?php   echo $desc . '</label></div>' . $br . "\n";
}

?>
