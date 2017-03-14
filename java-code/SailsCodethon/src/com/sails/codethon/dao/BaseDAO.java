package com.sails.codethon.dao;

import java.sql.Connection;
import java.sql.DriverManager;

public abstract class BaseDAO {

	private Connection connection = null;
	
	protected Connection getConnection() throws Exception {
		if(connection==null) {
			Class.forName("com.mysql.jdbc.Driver");
			connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/sails-catdb","sails_db","Sails1119");
		}
		return connection;
	}
}
