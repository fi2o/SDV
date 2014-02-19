<?php
function get_flash($path,$width,$height,$bgcolor='#ffffff') {

	$swf  = '<!--[if !IE]> -->';
	$swf .= '<object type="application/x-shockwave-flash"';
	$swf .= 'data="'.$path.'" width="'.$width.'" height="'.$height.'">';
	$swf .= '<!-- <![endif]-->';
	
	$swf .= '<!--[if IE]>';
	$swf .= '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"';
	$swf .= 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"';
	$swf .= 'width="'.$width.'" height="'.$height.'">';
	$swf .= '<param name="movie" value="'.$path.'" />';
	$swf .= '<!--><!---->';
	$swf .= '<param name="bgcolor" value="'.$bgcolor.'" />';
	$swf .= '<param name="loop" value="true" />';
	$swf .= '<param name="menu" value="false" />';
	$swf .= '<param name="wmode" value="transparent">';
	$swf .= '<param name="quality" value="high">';
		
	$swf .= '<p>Tu navegador nesesita el Plugin de Flash.</p>';
	$swf .= '</object>';
	$swf .= '<!-- <![endif]-->';
	
	return $swf;
}
?>