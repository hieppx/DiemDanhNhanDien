import mysql
import mysql.connector as sql
try:
    db = sql.connect(host="localhost", user="root", passwd="", database="db_diemdanh")
    print("Kết nối csdl thành công!")
    cur = db.cursor()
except sql.errors.DatabaseError:
    print("Kết nối csdl không thành công!")
    exit()