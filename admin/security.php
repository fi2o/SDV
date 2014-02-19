<?php
if (!isset($_SESSION['IDUSERS'])) {
	@goto2('admin/login.php');
}
?>