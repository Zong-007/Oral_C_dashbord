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
    ?>

    <style>
        /* จัดฟอร์มให้อยู่ตรงกลางหน้าจอ */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
        }

        /* สไตล์กล่องฟอร์ม */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%; /* ใช้ 50% ของความกว้างหน้าจอ */
            max-width: 600px; /* จำกัดความกว้างสูงสุด */
            min-width: 300px; /* กำหนดความกว้างขั้นต่ำ */
            box-sizing: border-box; /* รวม padding และ border ในการคำนวณขนาด */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
        }

        button {
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
        }

        button:hover {
            background-color: #2e59d9;
        }
    </style>

</head>

<body id="page-top">

<form id="mobileForm" action="teble_data.php" method="GET" onsubmit="return validateForm()">
    
        <h1>Mobile Number</h1>
        <!-- ช่องสำหรับใส่เบอร์มือถือ -->
        <input 
            type="tel" 
            id="mobileNumber" 
            name="mobileNumber" 
            placeholder="กรอกหมายเลขโทรศัพท์" 
            required 
            pattern="[0-9]{10}" 
            style="padding: 10px; font-size: 16px;">
        <br><br>

        <!-- ปุ่ม Submit -->
        <button type="submit" style="padding: 10px 20px; font-size: 16px;">Submit</button>
    </form>

    <script>
        function validateForm() {
            // ดึงค่า input ของหมายเลขโทรศัพท์
            const mobileNumber = document.getElementById('mobileNumber').value;

            // ตรวจสอบว่ามีการกรอกข้อมูลหรือไม่
            if (mobileNumber.trim() === "") {
                alert("กรุณากรอกหมายเลขโทรศัพท์มือถือ!");
                return false; // ป้องกันการส่งฟอร์ม
            }

            // ตรวจสอบรูปแบบ (10 หลัก)
            const pattern = /^[0-9]{10}$/;
            if (!pattern.test(mobileNumber)) {
                alert("กรุณากรอกหมายเลขโทรศัพท์ให้ถูกต้อง (10 หลัก)!");
                return false; // ป้องกันการส่งฟอร์ม
            }

            return true; // อนุญาตให้ส่งฟอร์มได้
        }
    </script>

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