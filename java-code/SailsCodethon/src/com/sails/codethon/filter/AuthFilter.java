package com.sails.codethon.filter;

import java.io.IOException;

import javax.servlet.Filter;
import javax.servlet.FilterChain;
import javax.servlet.FilterConfig;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.ServletRequest;
import javax.servlet.ServletResponse;
import javax.servlet.annotation.WebFilter;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import com.sails.codethon.model.User;
import com.sails.codethon.service.LoginService;

/**
 * Servlet Filter implementation class AuthFilter
 */
@WebFilter("/AuthFilter")
public class AuthFilter implements Filter {

	private LoginService loginService;
	
	ServletContext context;
	
    /**
     * Default constructor. 
     */
    public AuthFilter() {
    	if(loginService==null) {
        	loginService = LoginService.createNew();
        }
    }

	/**
	 * @see Filter#destroy()
	 */
	public void destroy() {
		// TODO Auto-generated method stub
	}

	/**
	 * @see Filter#doFilter(ServletRequest, ServletResponse, FilterChain)
	 */
	public void doFilter(ServletRequest request, ServletResponse response, FilterChain chain) throws IOException, ServletException {
		// TODO Auto-generated method stub
		// place your code here

		// pass the request along the filter chain
		String username = request.getParameter("username");
		String password = request.getParameter("password");
		User user = null;
		try {
			if(username==null || "".equals(username) || password==null || "".equals(password)
					|| (user = loginService.verifyLogin(username, password))==null) {
				RequestDispatcher dispatcher = context.getRequestDispatcher("/jsps/login.jsp");
				response.getWriter().println("<font color=red>Either username or password is incorrect</font>");
				dispatcher.include(request, response);
			}
			else {
				HttpServletRequest httpRequest = (HttpServletRequest)request;
				HttpServletResponse httpResponse = (HttpServletResponse)response;
				HttpSession session = httpRequest.getSession();
				session.setAttribute("user", user);
				session.setMaxInactiveInterval(30*60);
				Cookie cookie = new Cookie("user", username);
				cookie.setMaxAge(30*60);
				httpResponse.addCookie(cookie);
				chain.doFilter(request, response);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}

	/**
	 * @see Filter#init(FilterConfig)
	 */
	public void init(FilterConfig fConfig) throws ServletException {
		// TODO Auto-generated method stub
		context = fConfig.getServletContext();
	}

}
