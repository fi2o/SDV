<?php
require 'config.php';
$id_provincia=(int)$_GET["id_video"];
// -------------------------------------------------------
$db = db();

$noti = $db->get_row('videosyt',$id_provincia);

if ($db->num_rows()!=1)
{
	goto2('index.php');
}
?>
	<div id="video-perfil-iframe">
		<iframe width="728" height="405" src="//www.youtube.com/embed/<?php echo $noti['linkv'] ?>" frameborder="0" allowfullscreen></iframe>
	</div>
	<h3 id="video-perfil-title" class="main-heading video-heading"><?php echo $noti['nvideo'] ?></h3>