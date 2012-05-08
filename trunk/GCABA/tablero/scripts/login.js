function selectLoginAction(form) {
	if ($('selectLoginMode').value != 'affiliateUser')
		$('loginFormDo').value = 'usersDoLogin';
	else
		$('loginFormDo').value = 'affiliatesUsersDoLogin';
}
