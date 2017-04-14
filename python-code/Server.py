from flask import Flask, render_template,Response,jsonify,session,redirect,make_response
from database import login_db
import json
from flask import request

from ConfigParser import ConfigParser

config = ConfigParser()
config.read('config.ini')

port = config.get('Server', 'port')


app = Flask(__name__)
app.secret_key = 'pavanarya'
app.config['SESSION_TYPE'] = 'filesystem'


@app.route('/', methods=['GET', 'POST'])
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        psw = request.form['psw']

        users = login_db(username,psw)

        if(users.__len__() > 0):
            session['user'] = users[0]
            return redirect('/home', code=302)

    return render_template('login.html')
@app.route('/home', methods=['GET'])
def home():
    return render_template('home.html')

if __name__ == '__main__':
    app.run(threaded=True, host='0.0.0.0', port=5002)
