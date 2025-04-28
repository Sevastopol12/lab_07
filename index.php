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
                <!-- Dropdown to select SQL file -->
                <label for="sql_command">Chọn SQL Command: </label>
                <select name="sql_command" id="sql_command">
                    <option value="">-- Chọn --</option>
                    <option value="a.php">a. Top 10 bài tin nhiều like</option>
                    <option value="b.php">b. Tìm bài viết công nghệ</option>
                    <option value="c">c. Lọc theo danh mục</option>
                    <option value="d.php">d. Bình luận theo bài viết</option>
                    <option value="e.php">e. Độc giả bình luận từ khoá</option>
                    <option value="f.php">f. Tính tổng lượt thích</option>
                    <option value="g.php">g. Thêm bài viết mới</option>
                    <option value="h.php">h. Thêm bình luận mới</option>
                    <option value="i.php">i. Cập nhật nội dung bài viết</option>
                </select>
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
                    $dbname = "baiviet_db";      // your database name

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("<p style='color:red;'>Kết nối thất bại: " . $conn->connect_error . "</p>");
                    }

                    // Determine query
                    $query = "";

                    if (!empty($_POST["sql_command"])) {
                        $command_file = 'script/' . basename($_POST["sql_command"]); // <-- change to 'script/'
                        if (file_exists($command_file)) {
                            include($command_file); // inside this file, a variable $query must be defined
                        } else {
                            echo "<p style='color:red;'>File SQL không hợp lệ.</p>";
                            exit;
                        }
                    } elseif (!empty($_POST["query"])) {
                        $query = $_POST["query"];
                    } else {
                        echo "<p style='color:red;'>Không có lệnh SQL nào được nhập.</p>";
                        exit;
                    }

                    // Execute the query
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
