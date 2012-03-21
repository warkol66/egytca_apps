function changeAction(form) {
	if ($('select').value == "affiliate")
		form.action = "Main.php?do=affiliatesUsersDoLogin";
	else
		form.action = "Main.php?do=usersDoLogin";
}
