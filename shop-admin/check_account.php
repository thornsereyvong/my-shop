<?php
/*
 * *****************************************************************************
 * file: check_account.php
 * @autor: Thorn sereyvong
 * @date: 24-03-2016
 * ZOBENZ TEAM
 * *****************************************************************************
 */

if(!isset($_SESSION['ZOBENZ_USER']) && !isset($_SESSION['ZOBENZ_USERID']) && !isset($_SESSION['ZOBENZ_USER_ROLE'])){
	header('Location: '.$server.'login-account');
	exit();
}