<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giả lập MySQL Interface</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Thanh bên trái -->
        <div class="sidebar">
            <h2>Database</h2>
            <ul>
                <li>tbl_nguoidung</li>
                <li>tbl_phanquyen</li>
                <li>tbl_danhmuc</li>
                <li>tbl_docgia</li>
                <li>tbl_bantin</li>
                <li>tbl_dangbai</li>
                <li>tbl_binhluan</li>
            </ul>
        </div>

        <!-- Khu vực chính -->
        <div class="main">
            <h1>SQL Query</h1>
            <form method="post" action="">
                <textarea name="query" placeholder="Nhập lệnh SQL ở đây..."><?php echo isset($_POST['query']) ? htmlspecialchars($_POST['query']) : ''; ?></textarea>
                <br>
                <button type="submit">Go</button>
            </form>

            <!-- Khu vực kết quả -->
            <div class="result">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Connect to MySQL
                    $servername = "localhost"; // if using XAMPP
                    $username = "root";         // default username
                    $password = "";             // default no password
                    $dbname = "baiviet_db";     // your database name

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("<p style='color:red;'>Kết nối thất bại: " . $conn->connect_error . "</p>");
                    }

                    $query = $_POST["query"];

                    // Execute query
                    if ($conn->multi_query($query)) {
                        do {
                            if ($result = $conn->store_result()) {
                                echo "<h3>Kết quả truy vấn:</h3>";
                                echo "<table border='1' cellpadding='5' cellspacing='0'>";
                                echo "<tr>";
                                while ($field = $result->fetch_field()) {
                                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                                }
                                echo "</tr>";

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    foreach ($row as $cell) {
                                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                                $result->free();
                            } else {
                                if ($conn->errno) {
                                    echo "<p style='color:red;'>Lỗi: " . $conn->error . "</p>";
                                } else {
                                    echo "<p style='color:green;'>Thành công! Affected rows: " . $conn->affected_rows . "</p>";
                                }
                            }
                        } while ($conn->more_results() && $conn->next_result());
                    } else {
                        echo "<p style='color:red;'>Lỗi thực thi: " . $conn->error . "</p>";
                    }

                    $conn->close();
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
