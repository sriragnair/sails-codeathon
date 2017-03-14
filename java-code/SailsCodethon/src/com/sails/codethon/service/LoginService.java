package com.sails.codethon.service;

import com.sails.codethon.dao.LoginDAO;
import com.sails.codethon.model.User;

public class LoginService {

	private LoginDAO loginDAO;
	
	public LoginService() {
		if(loginDAO==null) {
			loginDAO = LoginDAO.createNew();
		}
	}
	
	public User verifyLogin(String username, String password) throws Exception {
		return loginDAO.verifyUser(username, password);
	}

	public static LoginService createNew() {
		return new LoginService();
	}
}
