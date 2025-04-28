<?php
$query = "
INSERT INTO tbl_binhluan (tieude, noidung, n_like, id_bantin, id_docgia)
VALUES (
  'Bài viết hay!',
  'Mình nghĩ Samsung sẽ làm tốt hơn vì họ hiểu thị trường hơn Apple. Nhưng so sánh vậy có phần ngốc nghếch.',
  0,
  (SELECT id_bantin FROM tbl_bantin WHERE tieude = 'Liệu Samsung sẽ thành công với Galaxy S4 hay sẽ rơi vào tình trạng suy giảm sự tin cậy của nhà đầu tư như Apple'),
  1
);
";
?>
