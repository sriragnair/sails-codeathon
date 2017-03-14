<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@ page import="com.sails.codethon.model.User" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sails Codethon - Welcome</title>
</head>
<body>
<% User user = (User) session.getAttribute("user");  
if(user!=null) {
	response.sendRedirect(request.getServletContext().getContextPath()+"/jsps/application.jsp");
}
%>
<h1> Welcome to Sails Codethon. </h1>
<h3> You can go to login page by clicking on below link and from there you have to build the solution. </h3>
<a href="${pageContext.request.contextPath}/jsps/login.jsp" id="loginPageLink">Login</a>
<jsp:include page="/jsps/footer.jsp"></jsp:include>
</body>
</html>