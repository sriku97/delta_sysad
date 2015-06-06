#!/usr/bin/python
#MySQLdb must be installed for the script to work
#this script must be run as a root user
import os
import sys
import subprocess
import getpass
os.chdir(sys.argv[1]) #changes the directory to that of the argument
file1=open("script1.py","w")
file2=open("script2.py","w")
file1.write('''#!/usr/bin/python
import MySQLdb
db=MySQLdb.connect("localhost","root","password")
cursor=db.cursor()
cursor._defer_warnings = True
cursor.execute("drop database if exists database1")
cursor._defer_warnings = False
cursor.execute("create database database1")
cursor.execute("use database1")
cursor._defer_warnings = True
cursor.execute("drop table if exists database1.timestore")
cursor._defer_warnings = False
cursor.execute("create table timestore(times time)")
db.commit()
''')
file2.write('''#!/usr/bin/python
import MySQLdb
db=MySQLdb.connect("localhost","root","password","database1")
cursor=db.cursor()
cursor.execute("insert into timestore values(now())")
db.commit()
''')
os.chmod("script1.py",0700)
os.chmod("script2.py",0700)
subprocess.Popen(['python','script1.py'])
cronfile=open("/var/spool/cron/crontabs/"+getpass.getuser(),"w")
cronfile.write("*/10 * * * * "+sys.argv[1]+"/script2.py")