<?php
$query = "
SELECT bl.*
FROM tbl_binhluan bl
JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
WHERE bt.tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kì thương mại điện tử';
";
?>