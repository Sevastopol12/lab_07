<?php
$query = "
SELECT bt.*
FROM tbl_bantin bt
JOIN tbl_danhmuc dm ON bt.id_danhmuc = dm.id_danhmuc
WHERE dm.ten_danhmuc IN ('Giáo dục', 'Đời sống');
";
?>