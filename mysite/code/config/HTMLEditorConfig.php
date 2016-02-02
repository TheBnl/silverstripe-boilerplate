<?php

/**
 * Clean up the tinyMCE
 * @author Bram de Leeuw
 * Date: 26/01/16
 */
$formats = array(

	/**
	 * Example:
	 * /
	array(
		'title' => 'Voorbeeld'
	),
	array(
		'title' => 'Voorbeeld',
		'classes' => 'voorbeeld',                       // classes adds an extra class
		'attributes' => array('class'=>'voorbeeld'),    // attributes replaces the current class
		'inline' => 'span',                             // inline doesn't care for the element and adds an span around the selection
		'selector' => 'i,em,b,strong,a'                 // selector cares for the element and doesn't add the class to any other element
	), //*/

);

//Set the dropdown menu options
HtmlEditorConfig::get('cms')->setOption('style_formats',$formats);
// Reconstruct editor toolbar with less buttons
HtmlEditorConfig::get('cms')->setButtonsForLine(1,
	'pastetext',
	'bold',
	'italic',
	'justifyleft',
	'justifycenter',
	'styleselect',
	'formatselect',
	'bullist',
	'numlist',
	'outdent',
	'blockquote',
	'indent',
	'code',
	'fullscreen'
);
HtmlEditorConfig::get('cms')->setButtonsForLine(2,
	'image',
	'link',
	'unlink',
	'anchor',
	'hr',
	'table',
	'row_props',
	'cell_props',
	'row_before',
	'row_after',
	'delete_row',
	'col_before',
	'col_after',
	'delete_col',
	'split_cells',
	'merge_cells'
);
HtmlEditorConfig::get('cms')->setButtonsForLine(3,''); // Delete line 3
// Remove h1 tag option
HtmlEditorConfig::get('cms')->setOption('theme_advanced_blockformats', 'p,address,pre,h3,h4,h5,h6');