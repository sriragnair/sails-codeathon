<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="com.sails.codethon.model.User" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sails Codethon - Application</title>
</head>
<body>
<% User user = (User) session.getAttribute("user");  %>
	<div> Hello, <%= user.getFirstName() %> <%= user.getLastName() %> 
		<form id="logoutForm" action="${pageContext.request.contextPath}/LogoutAction" style="float: right;" method="post">
			<a href="#" onclick="logout();">Logout</a>
		</form>
	</div>
</body>
<script type="text/javascript">
	function logout() {
		document.forms[0].submit();	
	}
	
</script>
</html>