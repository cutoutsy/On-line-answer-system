<?php
	session_start();
	require_once('../../classes/vcode.class.php');
	echo new Vcode();