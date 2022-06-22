
from library import *
from connectdb import *
def diemdanh():
    cur = db.cursor()
    cur.execute("SELECT student_name FROM students")
    myresult = cur.fetchall()
    index1 = -1
    name = []
    for x in myresult:
        index1 += 1
        name.append(myresult[index1])
    model = load_model('keras_model.h5')
    data = np.ndarray(shape=(1, 224, 224, 3), dtype=np.float32)
    cam = cv2.VideoCapture(0)
    ret, frame = cam.read()
    while (True):
        cv2.imshow('frame', frame)
        break
    cv2.imwrite('DataImages/images.jpg', frame)
    image = Image.open('DataImages/images.jpg')
    size = (224, 224)
    image = ImageOps.fit(image, size, Image.ANTIALIAS)
    image_array = np.asarray(image)
    normalized_image_array = (image_array.astype(np.float32) / 127.0) - 1
    data[0] = normalized_image_array
    prediction = model.predict(data)
    index = -1
    max_value = -1
    for i in range(0, len(prediction[0])):
        if max_value < prediction[0][i]:
            max_value = prediction[0][i]
            index = i
    mycursor1 = db.cursor()
    sql = "UPDATE students SET status = '1' WHERE student_name = '%s'" % (name[index])
    messagebox.showinfo("Thông báo!", "Chào sinh viên: %s !" % (name[index]))
    mycursor1.execute(sql)
    db.commit()

