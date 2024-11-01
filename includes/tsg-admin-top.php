<?php
/*

This code is Copyright 2018 by Bruce E. Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.txt.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

require_once(dirname( __FILE__ ) . '/tsg-admin-lib.php'); // NOW - load the admin stuff

function tsg_admin_page() {
    tsg_submits();

        $name = 'Generic Plugin (V ' . tsg_VERSION . ')';
?>

<div class="atw-wrap">
    <h2><?php echo $name;?> - Settings</h2>
    <hr />

<div id="tabwrap_plus" style="padding-left:5px;">
    <div id="tab-container-plus" class='yetii'>
	<ul id="tab-container-plus-nav" class='yetii'>


    <li ><a href="#tab-options" title="Filters"><?php echo(tsg_t_('Theme Support Options' /*a*/ )); ?></a></li>


    <li ><a href="#tab-help" title="Style"><?php echo(tsg_t_('Quick Start Help' /*a*/ )); ?></a></li>

	</ul>
        <hr />

<?php   /* IMPORTANT - in spite of the id's, these MUST be in the correct order - the same as the above list... */
?>

        <!-- ******* -->

        <div id="tab-options" class="tab_plus" > <!-- Filter -->
<?php
            require_once(dirname( __FILE__ ) . '/tsg-options-admin.php'); // NOW - load the admin stuff
            tsg_opts_admin();
?>
        </div>

        <!-- ******* -->

        <div id="tab-help" class="tab_plus" > <!-- Help -->

<?php
            require_once(dirname( __FILE__ ) . '/tsg-help-admin.php'); // NOW - load the admin stuff
            tsg_help_admin();
?>
        </div>
    </div>

</div> <!-- #tabwrap_plus -->

</div>

<script type="text/javascript">
	var tabber2 = new Yetii({
	id: 'tab-container-plus',
	tabclass: 'tab_plus',
	persist: true
	});
</script>


<?php
} // end tsg_admin

// ========================================= FORM DISPLAY ===============================


function tsg_t_($s) {
    return $s;
}


function tsg_submits() {
    // process settings for plugin parts


	// for each option section, define a svae filter for the save button. Add the name here, then call the handler.
    $actions = array('tsg_save_options'
        );


    foreach ( $actions as $functionName ) {
        if ( isset( $_POST[$functionName] ) ) {
            if ( tsg_submitted( $functionName ) && function_exists( $functionName ) ) {
                if ($functionName())
                    break;
            }
        }
    }
}

// ======================== options handlers ==========================



// ========================================= >>> tsg_save_options <<< ===============================
// *******

function tsg_save_options($show_message = true) {

    // **** text fields and selects

    $text_opts = array (
	);

    foreach ($text_opts as $opt) {
        $val = sanitize_text_field( tsg_get_POST( $opt ) );
        tsg_setopt( $opt, $val );
    }

    // **** check boxes
    $check_opts = array (
        'no_fitvids', 'have_flexible_video','reduced_full_width', 'no_load_edit_style',
    );

    foreach ($check_opts as $opt) {
        if ( tsg_get_POST( $opt ) != '' ) {
            tsg_setopt($opt, true );
        } else {
            tsg_setopt($opt, false );
        }
    }

    tsg_save_all_options();    // and save them to db
    if ( $show_message )
        tsg_save_msg('Options saved');
}
?>
