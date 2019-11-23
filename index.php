<meta charset="utf-8" />
<style>
    * {
  margin: 0;
  padding: 0;
}
 
/*==Style cơ bản cho website==*/
body {
  font-family: sans-serif;
  color: #333;
}
 
/*==Style cho menu===*/
#menu ul {
  background: #1F568B;
  list-style-type: none;
  text-align: left;
}
#menu li {
  color: #f1f1f1;
  display: inline-block;
  width: 120px;
  height: 40px;
  line-height: 40px;
  margin-left: -5px;
}

#menu a {
  text-decoration: none;
  color: #fff;
  display: block;
}
#menu a:hover {
  background: #F1F1F1;
  color: #333;
}
</style>
<div id="menu">
    <ul>
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="index.php?type='dienthoai'">Điện thoại</a></li>
        <li><a href="index.php?type='mayanh'">Máy ảnh</a></li>
        <li><a href="index.php?type='phukien'">Phụ kiện</a></li>
        <li><a style="text-align: right; " href="cart.php">Giỏ hàng</a></li>
    </ul>
</div>

<h3 style="text-align: center;"> Tất cả sản phẩm </h3>
<?php
$product = array();
$product[] = array(
    "id"  => 1,
    "pic"  => "",
    "name" => "Realme 5",
    "price" => "3500000",
    "type"=>"dienthoai"
);
$product[] = array(
    "id"  => 2,
    "pic"  => "image/realme5.jpg",
    "name" => "Realme 5 pro",
    "price" => "4500000",
    "type"=>"dienthoai"
);
$product[] = array(
    "id"  => 3,
    "pic"  => "image/realme5pro.jpg",
    "name" => "Realme XI",
    "price" => "7500000",
    "type"=>"dienthoai"
);
$product[] = array(
    "id"  => 4,
    "pic"  => "image/xiaominote8.jpg",
    "name" => "Xiaomi note 8",
    "price" => "3505000",
    "type"=>"dienthoai"
);
$product[] = array(
    "id"  => 5,
    "pic"  => "image/note8pro.jpg",
    "name" => "Xiaomi note 8 pro",
    "price" => "5500000",
    "type"=>"dienthoai"
);
$product[] = array(
    "id"  => 6,
    "pic"  => "image/iphone11.jpg",
    "name" => "Iphone 11 ",
    "price" => "22200000",
    "type"=>"dienthoai"
);
foreach ($product as $listProduct) {
    echo "<ul>";
    echo "<li> <img width='100px' src='".$listProduct['pic']."' >
              <h3>" . $listProduct['name'] . "</h3>
              <p> Giá bán:" . number_format($listProduct['price'], 0) . "</p> 
              <p><a href='cart.php?id=" . $listProduct['id'] . "'>Đặt hàng </a>
          </li>";
    echo "</ul>";
}
?>