from library import *
from home import home
from connectdb import *

win = Tk()
win.geometry("500x325")
win.title("Đăng nhập")

image1 = Image.open("C:\\Users\\Mr Bingi\\PycharmProjects\\DiemDanhNhanDien\\images\\vku.png")
test = ImageTk.PhotoImage(image1)
label1 = Label(win, image=test)
label1.image = test

label1.place(x=150, y=0)
icon = PhotoImage(file='C:\\Users\\Mr Bingi\\PycharmProjects\\DiemDanhNhanDien\\images\\home.png')
win.iconphoto(True, icon)


def login():
    try:
        user = user1.get()
        passwd = passwd1.get()
        cur.execute("SELECT email_lecturers, pass_lecturers, name_lecturers, degree_lecturers FROM lecturers WHERE email_lecturers = '%s' AND pass_lecturers = '%s'" % (user, passwd))
        rud = cur.fetchall()
        if rud:
            sql1 = "UPDATE lecturers SET status = '0'"
            cur.execute(sql1)
            sql = "UPDATE lecturers SET status = '1' WHERE  email_lecturers = '%s'" % (user)
            cur.execute(sql)
            db.commit()
            win.destroy()
            for x in rud:
                name = x[2]
                degree = x[3]
            home(name, degree)
        else:
            messagebox.showinfo("Thông báo!", "Tài khoản hoặc mật khẩu sai!")
    except mysql.connector.errors.ProgrammingError:
        print("Error")

userlvl = Label(win, text="Username :")
passwdlvl = Label(win, text="Password  :")
user1 = Entry(win, textvariable=StringVar())
passwd1 = Entry(win, textvariable=StringVar().set(""), show='*')
enter = Button(win, text="Đăng nhập", command=lambda: login(), bd=1)
user1.place(x=200, y=190)
passwd1.place(x=200, y=240)
userlvl.place(x=130, y=190)
passwdlvl.place(x=130, y=240)
enter.place(x=225, y=280)

if __name__ == '__main__':
    win.mainloop()

