<?php
$query = "
INSERT INTO tbl_bantin (id_danhmuc, tieude, hinhanh, noidung, tukhoa, nguontin, n_like, rating)
VALUES (
  (SELECT id_danhmuc FROM tbl_danhmuc WHERE ten_danhmuc = 'Công nghệ'),
  'Xu hướng AI trong năm 2025',
  'ai2025.jpg',
  'AI đang thay đổi nhiều lĩnh vực trong đời sống...',
  'AI, công nghệ, năm 2025',
  'vnexpress.net',
  0,
  0
);
";
?>
