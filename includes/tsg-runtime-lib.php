<?php
function tsg_alert($msg) {
	echo "<script> alert('" . esc_html($msg) . "'); </script>";
}

// ===============================  options =============================
$tsg_opts_cache = false;
function tsg_getopt($opt) {
    global $tsg_opts_cache;
    if (!$tsg_opts_cache) {
        $tsg_opts_cache = get_option('tsg_settings' ,array());
    }

    if (!isset($tsg_opts_cache[$opt]))	// handles changes to data structure
      {
        return false;
      }
    return $tsg_opts_cache[$opt];
}

function tsg_setopt($opt, $val, $save = true) {
    global $tsg_opts_cache;
    if (!$tsg_opts_cache)
        $tsg_opts_cache = get_option('tsg_settings', array());

    $tsg_opts_cache[$opt] = $val;
    if ($save)
        tsg_wpupdate_option('tsg_settings',$tsg_opts_cache);
}


//----

function tsg_save_all_options() {
    global $tsg_opts_cache;

    if ($tsg_opts_cache) // don't save anyting if we have nothing to save yet.
        tsg_wpupdate_option('tsg_settings',$tsg_opts_cache);
}

function tsg_delete_all_options() {
    global $tsg_opts_cache;
    $tsg_opts_cache = false;
    if (current_user_can( 'manage_options' ))
        delete_option( 'tsg_settings' );
}

function tsg_wpupdate_option($name, $opts) {
    if (current_user_can( 'manage_options' )) {
        update_option($name, $opts);
    }
}

?>
