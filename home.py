from library import *
from diemdanh import *
from danhsach import *

from connectdb import *



def home(name, degree):
    test = Tk()
    test.geometry("500x250")
    test.title("Trang chủ")
    hello = Label(test, text="Chào " + degree + " " + name + "!", font=("Arial", 25))
    inputID = Label(test, text="Nhập ID môn học: ", font=("Arial", 10))
    id_monHoc = Entry(test, textvariable=StringVar())
    diem_danh = Button(test, text="Điểm danh", command=lambda: diemdanh(), bd=2)
    listsv = Button(test, text="Danh sách", command=lambda: danhsachsinhvien(), bd=2)
    diem_danh.place(x=160, y=170)
    listsv.place(x=280, y=170)
    id_monHoc.place(x=230, y=100)
    inputID.place(x=110, y=100)
    hello.place(x=45, y=35)
    enter = Button(test, text="Xác nhận", command=lambda: ok_id(id_monHoc), bd=1)
    enter.place(x=360, y=100)

    test.mainloop()

def ok_id(id_monHoc):
    try:
        idMonHoc = id_monHoc.get()
        mycursor1 = db.cursor()

        sql1 = "UPDATE hocphan SET status = '0' WHERE  id_hocphan"
        mycursor1.execute(sql1)

        sql = "UPDATE hocphan SET status = '1' WHERE  id_hocphan = '%s'" % (idMonHoc)
        mycursor1.execute(sql)
        db.commit()

        cur = db.cursor()
        cur.execute("SELECT ten_hocphan FROM hocphan WHERE id_hocphan = '%s' LIMIT 1" % (idMonHoc))
        myresult = cur.fetchall()
        messagebox.showinfo("Thông báo!", "Môn học: %s"%(myresult[0]))
    except mysql.connector.errors.ProgrammingError:
        messagebox.showinfo("Thông báo!", "Không có môn học này!")