from flask import Flask, render_template,Response,jsonify,session,redirect,make_response
from database import *
import json
from flask import request

from ConfigParser import ConfigParser

config = ConfigParser()
config.read('config.ini')

port = config.get('Server', 'port')


app = Flask(__name__)
app.secret_key = 'pavanarya'
app.config['SESSION_TYPE'] = 'filesystem'


@app.route('/')
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        psw = request.form['psw']

        if username == "paryasomayajulu" and psw == "anmurthy@123":
            session['username'] = username
            return redirect('/admin/posts',code=302)

    return render_template('login.html')


if __name__ == '__main__':
    app.run(threaded=True, host='0.0.0.0', port=int(port))
