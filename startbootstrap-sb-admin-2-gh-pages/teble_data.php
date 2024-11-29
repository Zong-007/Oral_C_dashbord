<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Oral_C</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <?php
        // กำหนดค่าตัวแปรสำหรับการเชื่อมต่อฐานข้อมูล
        $servername = "m7nj9dclezfq7ax1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com"; // ชื่อเซิร์ฟเวอร์ฐานข้อมูล
        $username = "p1jryqynwuzez4tj"; // ชื่อผู้ใช้ฐานข้อมูล
        $password = "hbjnf2ffhkcvcnak"; // รหัสผ่านฐานข้อมูล
        $dbname = "ickshh2zl54q79ab"; // ชื่อฐานข้อมูลของเรา

        try {
            // สร้างการเชื่อมต่อฐานข้อมูลโดยใช้ PDO
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            // ตั้งค่าให้ PDO แสดงข้อผิดพลาดเป็นข้อยกเว้น (Exception)
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // แสดงข้อความเมื่อการเชื่อมต่อล้มเหลว และแสดงข้อผิดพลาด
            echo "Connection failed: " . $e->getMessage();
            exit(); // หยุดการทำงานของโปรแกรม
        }
        
        // รับค่าเบอร์มือถือจากแบบฟอร์ม
        $mobileNumber = isset($_GET['mobileNumber']) ? $_GET['mobileNumber'] : '';

        // ตัวแปรเก็บชื่อผู้ใช้
        $userNames = []; // ใช้สำหรับเก็บชื่อผู้ใช้ในกรณีหลายชื่อ

        // รับค่าเบอร์มือถือจากแบบฟอร์ม
        $mobileNumber = isset($_GET['mobileNumber']) ? $_GET['mobileNumber'] : '';

        // ตัวแปรเก็บชื่อผู้ใช้และชื่อคลินิก
        $userName = ''; // เก็บชื่อผู้ใช้
        $clinicName = ''; // เก็บชื่อคลินิก

        // ตรวจสอบว่ามีการกรอกเบอร์มือถือหรือไม่
        if (!empty($mobileNumber)) {

            // คำสั่ง SQL เพื่อดึงข้อมูลตามหมายเลขโทรศัพท์
            $sql = 'SELECT User_Name, Clinic_name FROM Oral_C_data WHERE Mobile_No = :mobileNumber ORDER BY Mobile_No DESC LIMIT 1'; // เพิ่ม ORDER BY เพื่อให้ได้ข้อมูลล่าสุด
            $query = $conn->prepare($sql);
            $query->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR); // ผูกตัวแปรกับ SQL query
            $query->execute();
            
            // ตรวจสอบว่ามีข้อมูลที่พบหรือไม่
            if ($query->rowCount() > 0) {
                // ดึงผลลัพธ์และเก็บไว้ในตัวแปร $userName และ $clinicName
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $userName = $row['User_Name']; // เก็บชื่อผู้ใช้
                $clinicName = $row['Clinic_name']; // เก็บชื่อคลินิก
                
            } else {
                // ถ้าไม่พบข้อมูล
                echo "<tr><td colspan='2'>ไม่พบข้อมูลสำหรับหมายเลขโทรศัพท์ที่ระบุ.</td></tr>";
            }
        } else {
            // ถ้ายังไม่ได้กรอกเบอร์มือถือ
            echo "<tr><td colspan='2'>กรุณาใส่หมายเลขโทรศัพท์เพื่อค้นหา.</td></tr>";
        }
        ?>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?= htmlspecialchars($userName) ?></h1>
                    <h4 class="mb-4"><?= htmlspecialchars($clinicName) ?>.</h4>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">ประวัติผลการตรวจผล</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tbody>
                                <?php
                                try {
                                    // รับค่าเบอร์มือถือจากแบบฟอร์ม
                                    $mobileNumber = isset($_GET['mobileNumber']) ? $_GET['mobileNumber'] : '';

                                    // ตรวจสอบว่ามีการกรอกเบอร์มือถือหรือไม่
                                    if (!empty($mobileNumber)) {
                                        // เตรียมคำสั่ง SQL สำหรับดึงข้อมูล 7 แถวล่าสุด
                                        $stmt = $conn->prepare("
                                            SELECT Trans_Date, Meet_Result 
                                            FROM Oral_C_data 
                                            WHERE Mobile_No = :mobileNumber 
                                            ORDER BY Trans_Date DESC 
                                            LIMIT 7
  
                                        ");
                                        $stmt->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR);

                                        // ดำเนินการคำสั่ง SQL
                                        $stmt->execute();

                                        // แสดงผลลัพธ์
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $meetResult = htmlspecialchars($row['Meet_Result']);
                                            $transDate = htmlspecialchars($row['Trans_Date']);

                                            // กำหนดสีและข้อความตาม Meet_Result
                                            if ($meetResult === "ปกติ") {
                                                $color = "green";
                                                $displayText = "Normal";
                                            } else {
                                                $color = "orange";
                                                $displayText = "Risk";
                                            }

                                            echo "<tr>";
                                            echo "<td>" . $transDate . "</td>";
                                            echo "<td style='color: $color;'>" . $displayText . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2'>กรุณาใส่หมายเลขโทรศัพท์เพื่อค้นหา.</td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='2'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>