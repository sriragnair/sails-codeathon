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
import javax.servlet.http.HttpSession;

import com.sails.codethon.model.User;

/**
 * Servlet Filter implementation class RequestFilter
 */
@WebFilter("/RequestFilter")
public class RequestFilter implements Filter {

	ServletContext context;
    /**
     * Default constructor. 
     */
    public RequestFilter() {
        // TODO Auto-generated constructor stub
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
		
		String loginPageUri = context.getContextPath()+"/jsps/login.jsp";
		String indexPageUri = context.getContextPath()+"/jsps/index.jsp";
		String loginActionUri = context.getContextPath()+"/LoginAction";
		String sailsLogoUri = context.getContextPath()+"/img/sailsLogo.png";
		String landingPageUri = context.getContextPath()+"/";
		
		HttpServletRequest httpRequest = (HttpServletRequest)request;
		if(httpRequest.getRequestURI().equals(landingPageUri) || httpRequest.getRequestURI().equals(loginPageUri) 
				|| httpRequest.getRequestURI().equals(loginActionUri) || httpRequest.getRequestURI().equals(indexPageUri) || httpRequest.getRequestURI().equals(sailsLogoUri)) {
			chain.doFilter(request, response);
		} else {
			HttpSession session = httpRequest.getSession();
			User user = (User) session.getAttribute("user");
			boolean userAuth = false;
			if(user!=null) {
				String username = user.getUserName();
				String cookieValue = null;
				Cookie[] cookies = httpRequest.getCookies();
				for(Cookie cookie:cookies) {
					if("user".equals(cookie.getName())) {
						cookieValue = cookie.getValue();
					}
				}
				if(username.equals(cookieValue)) {
					userAuth=true;
				}
			}
			if(userAuth) {
				// pass the request along the filter chain
				chain.doFilter(request, response);
			} else {
				RequestDispatcher dispatcher = context.getRequestDispatcher("/jsps/login.jsp");
				response.getWriter().println("<font color=red>User session is not there. Please login.</font>");
				dispatcher.include(request, response);
			}
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
