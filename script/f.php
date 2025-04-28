<?php
$query = "
SELECT id_bantin, tieude, n_like
FROM tbl_bantin;

SELECT SUM(n_like) AS tong_like
FROM tbl_bantin;
";
?>