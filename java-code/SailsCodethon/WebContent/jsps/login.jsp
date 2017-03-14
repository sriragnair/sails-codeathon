<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@ page import="com.sails.codethon.model.User" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sails Codethon - Login</title>
</head>
<body>
<% User user = (User) session.getAttribute("user");  
if(user!=null) {
	response.sendRedirect(request.getServletContext().getContextPath()+"/jsps/application.jsp");
}
%>
<form id="loginForm" action="${pageContext.request.contextPath}/LoginAction" method="post">
	<div id="usernameDiv">
		<label id="usernameLabel"> UserName </label>
		<input type="text" name="username" id="username" for="usernameLabel" placeholder="Enter your username: ">
	</div>
	<div id="passwordDiv">
		<label id="PasswordLabel"> Password </label>
		<input type="password" name="password" id="password" for="passwordLabel" placeholder="Enter your Password: ">
	</div>
	<div id="submitDiv">
		<input type="submit" name="submit" value="Login">
	</div>
</form>
<jsp:include page="/jsps/footer.jsp"></jsp:include>
</body>
</html>