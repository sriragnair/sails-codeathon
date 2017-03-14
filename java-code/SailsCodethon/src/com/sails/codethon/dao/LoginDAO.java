package com.sails.codethon.dao;

import java.sql.Connection;
import java.sql.ResultSet;

import com.sails.codethon.model.User;

public class LoginDAO extends BaseDAO {

	private Connection connection = null;
	
	public User verifyUser(String username, String password) throws Exception {
		connection = getConnection();
		ResultSet resultSet = connection.createStatement().executeQuery("select * from sc_users where username = '"+username+"'");
		User user = null;
		if(resultSet.next()) {
			String originalPassword = resultSet.getString("password");
			if(originalPassword!=null && originalPassword.equals(password)) {
				user = new User();
				user.setId(resultSet.getInt("id"));
				user.setFirstName(resultSet.getString("firstname"));
				user.setLastName(resultSet.getString("lastname"));
				user.setUserName(resultSet.getString("username"));
			}
		}
		return user;
	}
	
	public static LoginDAO createNew() {
		return new LoginDAO();
	}
}
