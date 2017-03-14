package com.sails.codethon;

import java.io.IOException;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import com.sails.codethon.service.LoginService;

/**
 * Servlet implementation class LoginAction
 */
@WebServlet("/Logout")
public class LogoutAction extends HttpServlet {
	private static final long serialVersionUID = 1L;
	
	private LoginService loginService;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public LogoutAction() {
        super();
        if(loginService==null) {
        	loginService = LoginService.createNew();
        }
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		HttpSession session = request.getSession(false);
		if(session!=null) {
			session.invalidate();
		}
		Cookie cookie = new Cookie("user", null);
		response.addCookie(cookie);
		RequestDispatcher dispatcher = request.getServletContext().getRequestDispatcher("/jsps/login.jsp");
		response.getWriter().println("<font color=green>Logged out successfully</font>");
		dispatcher.include(request, response);
	}

}
