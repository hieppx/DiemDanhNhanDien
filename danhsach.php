<?php
#clearstatcache();
// require_once 'update_status.php';
$mysqli = new mysqli("localhost", "root", "", "db_diemdanh");


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$i = 1;


// Hiển thị sinh viên theo học phần
$sql = "SELECT students.* FROM students INNER JOIN hocphan ON students.id_monhoc = hocphan.id_hocphan WHERE hocphan.status=1";
$result = $mysqli->query($sql);

// Tính tổng số sinh viên theo học phần
$sql_count_total = "SELECT COUNT(student_name) AS total FROM students INNER JOIN hocphan ON students.id_monhoc = hocphan.id_hocphan WHERE hocphan.status=1";
$count_total = $mysqli->query($sql_count_total);
$data_count_total = $count_total->fetch_assoc();

// Tính số sinh viên vắng
$sql_count_student_off = "SELECT COUNT(student_name) AS total FROM students INNER JOIN hocphan ON students.id_monhoc = hocphan.id_hocphan WHERE hocphan.status=1 AND students.status=0";
$count_student_off = $mysqli->query($sql_count_student_off);
$data_count_student_off = $count_student_off->fetch_assoc();
// Hiển thị tên học phần
$cc = "SELECT * FROM hocphan INNER JOIN students ON hocphan.id_hocphan = students.id_monhoc WHERE hocphan.status=1 LIMIT 1";
$rl = $mysqli->query($cc);

// Hiển thị tên giáo viên
$gv = "SELECT * FROM lecturers WHERE lecturers.status=1";
$rl1 = $mysqli->query($gv);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- Gọi thư viện JQuery  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
        < script src = "https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js" >
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


    <div class="container">
        <br>

        <?php
        while ($gv1 = $rl1->fetch_assoc()) {
        ?>
            <center>
                <h2>Chào <span style="color:#14C38E;"> <?php echo $gv1["degree_lecturers"] . " " . $gv1["name_lecturers"] ?>
                    </span>!</h2>
            </CENTER>
        <?php } ?>

        <?php
        while ($monhoc = $rl->fetch_assoc()) {
        ?>
            <center>
                <h2>Học phần:<span style="color:blue;"> <?php echo $monhoc["ten_hocphan"] ?> </span></h2>
            </center>

        <?php } ?>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sinh viên</th>
                    <th>Lớp</th>
                    <th>Họ và tên</th>
                    <th>Trình trạng</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["student_id"] ?></td>
                        <td><?php echo $row["student_class"] ?></td>
                        <td><?php echo $row["student_name"] ?></td>
                        <td>
                            <form method="POST">
                                <button class="<?php if($row['status']==1){ echo "btn btn-success btn-status"; } else {echo "btn btn-danger btn-status";}?>" data-status="<?php echo $row["status"] ?>" data-id="<?php echo $row["id"] ?>" name="button2"><?php echo $row["status"] == 1 ? "Có mặt" : "&ensp;Vắng&ensp;" ?></button>
                        </td>
                        </form>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </div>
    <CENTER>
        <h3>Lớp học phần này có <?php echo $data_count_total['total']; ?> sinh viên và đang vắng
            <?php echo $data_count_student_off['total'] ?> sinh viên. Click vào nút dưới đây khi lớp đủ!</h3>
        <form method="POST"><input type="submit" class="btn btn-primary" name="button1" value="Lớp đủ" /></form>
    </CENTER>


    <?php
    if (isset($_POST['button1'])) {
        $conn = new mysqli('localhost', 'root', '', 'db_diemdanh');
        $full_class = "UPDATE students SET students.status = '1'";
        $result_full_class = $conn->query($full_class);
        header("Location: http://localhost/DiemDanhNhanDien/danhsach.php");
        exit;
    }
    ?>

    <?php
    if (isset($_POST['button2'])) {
        header("Location: http://localhost/DiemDanhNhanDien/danhsach.php");
        exit;
    }
    ?>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var $ = jQuery;
            $(".btn-status").on("click", function() {
                var dataID = $(this).attr("data-id");
                var dataStatus = $(this).attr("data-status");
                $.ajax({
                    url: "/DiemDanhNhanDien/update-status.php",
                    type: "post",
                    data: {
                        id: dataID,
                        status: dataStatus
                    },
                    success: function(response) {
                        console.log("success");
                        console.log(response);
                        var res = JSON.parse(response);
                        var classQuery = ".btn-status[data-id=" + dataID + "]";
                        //debugger;
                        $(classQuery).html(res.status ? "Có mặt" : "Vắng");
                        $(classQuery).attr("data-status", res.status ? "1" : "0");
                        // Swal.fire("Cập nhật thành công!");


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        console.log("error");
                    }
                });
            })
        });
    </script>

</body>

</html>