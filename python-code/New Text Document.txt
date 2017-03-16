import MySQLdb
import re
from ConfigParser import ConfigParser
from SendEmail import *
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
