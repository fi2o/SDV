<?php
define('PAGE_ID','noti');

require('config.php');

// -------------------------------------------------------
if (!ctype_digit($_GET['noti'])) {
	goto2('index.php');
}
$IDNEWS = sprintf('%u',$_GET['noti']);

// -------------------------------------------------------
$db = db();

$noti = $db->get_row('noticias',$IDNEWS);

if ($db->num_rows()!=1)
{
	goto2('index.php');
}

// -------------------------------------------------------
require_once('templates/head.php');
?>
<div id="noticia-perfil-title"><?php echo $noti['titulo'] ?></div>
<div id="noticia-perfil-img"><a href="images/noticias/<?php echo $noti['imagen'] ?>">
<img name="imagen" src="images/noticias/thumb400/<?php echo $noti['imagen'] ?>"  width="400" /></a></div> 
<div id="noticia-perfil-desc"><?php echo $noti['descripcion']?></div>
											<aside class="share_posts">
												<div class="fl">
													<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
													<script type="text/javascript">
														!function (d, s, id) { 
															var js = undefined, 
																fjs = d.getElementsByTagName(s)[0];
															
															if (!d.getElementById(id)) { 
																js = d.createElement(s);
																js.id = id;
																js.src = '//platform.twitter.com/widgets.js';
																
																fjs.parentNode.insertBefore(js, fjs);
															}
														} (document, 'script', 'twitter-wjs');
													</script>
												</div>
												<div class="fl">
													<div class="g-plusone" data-size="medium"></div>
													<script type="text/javascript">
														(function () { 
															var po = document.createElement('script'), 
																s = document.getElementsByTagName('script')[0];
															
															po.type = 'text/javascript';
															po.async = true;
															po.src = 'https://apis.google.com/js/plusone.js';
															
															s.parentNode.insertBefore(po, s);
														} )();
													</script>
												</div>
												<div class="fl">	
													<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div>
													<script type="text/javascript">
														(function (d, s, id) { 
															var js = undefined, 
																fjs = d.getElementsByTagName(s)[0];
															
															if (d.getElementById(id)) { 
																return;
															}
															
															js = d.createElement(s);
															js.id = id;
															js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
															
															fjs.parentNode.insertBefore(js, fjs);
														} (document, 'script', 'facebook-jssdk'));
													</script>
												</div>
                                                </aside>


<?php
require 'templates/footer.php';
?>