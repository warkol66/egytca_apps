<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

// List containing the registered chat users:
$users = array();

// Default guest user (don't delete this one):
$users[0] = array();
$users[0]['userRole'] = AJAX_CHAT_GUEST;
$users[0]['userName'] = null;
$users[0]['password'] = null;
$users[0]['channels'] = array(0);
//
//// Sample admin user:
//$users[1] = array();
//$users[1]['userRole'] = AJAX_CHAT_ADMIN;
//$users[1]['userName'] = 'admin';
//$users[1]['password'] = 'admin';
//$users[1]['channels'] = array(0,1);
//
//// Sample moderator user:
//$users[2] = array();
//$users[2]['userRole'] = AJAX_CHAT_MODERATOR;
//$users[2]['userName'] = 'moderator';
//$users[2]['password'] = 'moderator';
//$users[2]['channels'] = array(0,1);
//
//// Sample registered user:
//$users[3] = array();
//$users[3]['userRole'] = AJAX_CHAT_USER;
//$users[3]['userName'] = 'user';
//$users[3]['password'] = 'user';
//$users[3]['channels'] = array(0,1);


$sql = 'SELECT id,username,password FROM users_user WHERE 1;';
$result = $this->db->_db->_connectionID->query(trim($sql));

while($row = $result->fetch_row()) {
	
	if ($row[0] < 1) continue;
	
	$id = $row[0];
	$users[$id] = array();
	$users[$id]['userRole'] = AJAX_CHAT_USER;
	$users[$id]['userName'] = $row[1];
	$users[$id]['password'] = $row[2];
	$users[$id]['channels'] = array(0,1);
}
$result->close();

?>