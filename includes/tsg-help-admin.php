<?php
// ========================================= >>> tsg_select_filter <<< ===============================
function tsg_help_admin() {
    // admin for help
    $t_dir = tsg_plugins_url('/help/help.html', '');

    $title = "View Weaver Show Posts ";

?>
    <h2 style="color:blue;font-weight:bold;">Quick Start Help</h2>

<p>
	<em>Theme Support for Gutenberg</em> allows most existing WordPress themes to work much better with Gutenberg.
	By default, the new Gutenberg editor provides basic styling for its various blocks, but does not provide
	support for the new wide and full alignment styling that is a part of Gutenberg. Wide and Full alignment allows
	many blocks to be displayed beyond the standard widths of page and post content.
</p>
<p>
	With this plugin, Wide and Full align button options will be displayed in the Gutenberg editor, as well as then displaying
	those blocks with appropriate alignment in the visitor front-end display. This capability unleashes a powerful new
	display feature. Note that Wide and Full only look good on pages or single page view of posts without left or right
	sidebars. Many themes allow you to create pages without sidebars, while others don't. Some themes also hide overflow on
	content areas, which can make wide or full content clipped. If your theme only has sidebar layouts, or clips content, you
	will still get much better style support for Gutenberg blocks, but without good looking Wide or Full align widths.
</p>
<p>
	Many existing themes provide styling support for the legacy TinyMCE editor. What this means is that fonts and styling for
	most HTML elements like lists or headings will be styled the same in the editor as the final front-end display. Often, however,
	text layout widths and line breaks will not match from the editor to the front-end view. Unfortunately, many themes have
	not bothered to create the custom styling for the TinyMCE editor to match the theme's styling.
</p>
<p>
	It turns out that for almost all of the themes that have TinyMCE styling defined, that styling can easily be applied to the
	Gutenberg editor. That is not done by Gutenberg by default, but <em>Theme Support for Gutenberg</em> will use those legacy
	styling rules and apply them to Gutenberg, resulting in a very good editing experience.
</p>
<p>
	Please note that once you've installed Gutenberg, it will automatically be used whenever you open a page or post for editing,
	even if it is an old legacy page. Gutenberg does offer a legacy editing block, but that does not offer all the editing options
	that the legacy TinyMCE editor does. <em>Theme Support for Gutenberg</em> will add a new <strong>Edit (Classic)</strong> option
	on the top Admin bar that allows you to easily switch back to the classic editor. But please also note that once you've created
	or edited a page with Gutenberg, it is next to impossible to make any changes with the classic editor without breaking
	Gutenberg blocks - even simple spelling error fixes.
</p>
<p>
	Eventually, it is almost certain that many WordPress themes will add their own Gutenberg support. But for now, you can come
	close to a complete Gutenberg editing experience with this plugin. If you want to check out a theme that has total integration
	with Gutenberg, try our <em>Weaver Xtreme</em> theme. It is completely options based, and gives you total control over your
	site's design, and you can see what Gutenberg really offers!
</p>
<?php

}


/*
Free vs. Premium ideas...

Pro - add support for more qargs - just have the basic ones in the free version
reduce the options for different slide shows in the free.
*** */
?>
