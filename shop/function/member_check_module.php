<?
if (!isMember()) {
?>
<form name = "LoginModuleFrm" action = "<? echo ${MEMBER_MAIN_FILE_NAME}; ?>" method = "get">
<input type = "hidden" name = "query" value = "login">
<input type = "hidden" name = "ReturnUrl" value = "">

</form>
<script>
	document.LoginModuleFrm.ReturnUrl.value = escape(document.URL);
	document.LoginModuleFrm.submit();	
</script>
<?	
}
?>