import MySQLdb
import re
from ConfigParser import ConfigParser
import time


config = ConfigParser()
config.read('config.ini')

host = config.get('Database', 'host')
username = config.get('Database', 'username')
password = config.get('Database', 'password')
database = config.get('Database', 'database')


def sqlConnect():
    db = MySQLdb.connect(host=host,user=username,passwd=password,db=database, charset='utf8')
    return db
def login(username,password):
    conn = sqlConnect()
    cursor = conn.cursor()

    user =[]

    cursor.execute("SELECT * from sc_users where username='"+username+"' and password='"+password+"' ")
    for row in cursor.fetchall():
        user.append({'ID': row[0], 'firstname': row[1], 'lastname': row[2],'username':row[3]})

    conn.close()

    return user