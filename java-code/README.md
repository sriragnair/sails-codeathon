"# sails-codeathon"

Base framework code for java based web-app

1. Find the war file SailsCodethon.war in java-code/SailsCodethon/build folder.
2. Copy the war file to TOMCAT_HOME/webapps directory (TOMCAT_HOME is the root folder of tomcat. Here in my case is apache-tomcat-8.5.11).
3. Make sure TOMCAT_HOME/conf/server.xml has the below line.
<Host name="localhost"  appBase="webapps"
            unpackWARs="true" autoDeploy="true">
3. Go to TOMCAT_HOME and start the tomcat server by executing the below lines.
cd bin
./startup.sh
