<?php 
    class Product{
    var $id;
    var $price;
    var $name;
    var $pic;
    var $type;
    #end properties
    #Construct function
    function __construct($id, $name, $price, $pic,$type)
    {
        $this->id = $id;
        $this->price = $price;
        $this->name = $name;
        $this->pic = $pic;
        $this->type=$type;
    }
    #Member function
    function display()
    {
        echo "pic: " . $this->pic . "<br>";
        echo "name: " . $this->name . "<br>";
        echo "price: " . $this->price . "<br>";
    }
    #Mock data
    /**
     * Lấy toàn bộ các cuốn sách có trong CSDL
     */
    static function getList()
    {
        $listBook = array();
        array_push($listBook, new Product(1, "Realme 5 ", 3500000, "image/realme5.jpg","dienthoai"));
        array_push($listBook, new Product(2, "Realme 5 pro ", 4500000, "image/realme5pro.jpg","dienthoai"));
        array_push($listBook, new Product(3, "Realme 10 XI ", 5500000, "image/realmexi.jpg","dienthoai"));
        array_push($listBook, new Product(4, "Xiaomi note 8 ", 6500000, "image/xiaominote8.jpg","dienthoai"));
        array_push($listBook, new Product(5, "Xiaomi note 8 pro ", 7500000, "image/note8pro.jpg","dienthoai"));
        array_push($listBook, new Product(6, "Iphone 11 ", 11500000, "image/iphone11.jpg","dienthoai"));  
        array_push($listBook, new Product(7, "Nikon Coolpix W300", 3500000, "image/realme5.jpg","mayanh"));
        array_push($listBook, new Product(8, "Nikon D5600 Kit  ", 4500000, "image/realme5pro.jpg","mayanh"));
        array_push($listBook, new Product(9, "Nikon D7200 kit AF-S 18-140 ED VR", 5500000, "image/realmexi.jpg","mayanh"));
        array_push($listBook, new Product(10, "Nikon D3500 Kit AF-P 18-55 VR", 6500000, "image/xiaominote8.jpg","mayanh"));
        array_push($listBook, new Product(11, "Tai nghe Ip 7 ", 7500000, "image/note8pro.jpg","phukien"));
        array_push($listBook, new Product(12, "Ốp Iphone 11 ", 11500000, "image/iphone11.jpg","phukien"));  
        array_push($listBook, new Product(13, "Sạc dự phòng ", 3500000, "image/realme5.jpg","phukien"));
        array_push($listBook, new Product(14, "Headphone ", 4500000, "image/realme5pro.jpg","phukien"));
        array_push($listBook, new Product(15, "Gậy tự sướng ", 5500000, "image/realmexi.jpg","phukien"));
        array_push($listBook, new Product(16, "Nikon H142 ", 6500000, "image/xiaominote8.jpg","mayanh"));
        array_push($listBook, new Product(17, "Nikon D770", 7500000, "image/note8pro.jpg","mayanh"));
        array_push($listBook, new Product(18, "Nikon D850 Body", 11500000, "image/iphone11.jpg","mayanh"));        
        return $listBook;
    }
    /**
     * Lấy dữ liệu từ file
     */
    static function getListFromFile()
    {
        $arrData = file("data/book.txt", FILE_SKIP_EMPTY_LINES);
        $lsBook = array();
        foreach ($arrData as $key => $value) {
            $arrItem = explode("#", $value);
            if (count($arrItem) == 5) {
                $book = new Book($arrItem[0], $arrItem[1], $arrItem[2], $arrItem[3], $arrItem[4]);
                array_push($lsBook, $book);
            }
        };
        return $lsBook;
    }

    static function connect(){
        $username = "root"; // Khai báo username
        $password = "123456";      // Khai báo password
        $server   = "127.0.0.1";   // Khai báo server
        $dbname   = "book";      // Khai báo database

        // Kết nối database tintuc
        $connect = mysqli_connect($server, $username, $password, $dbname);

    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if ($connect->connect_error) {
        die("Không kết nối :" . $connect->connect_error);
        }
        return $connect;
    }

    static function getListFromDB(){
        $con = Book::connect();
        $sql= "select * from booka";
        $result=$con->query($sql);
        $lsBook=array();
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $book= new Book($row["id"],$row["price"],$row["title"],$row["auther"],$row["year"]);
                array_push($lsBook,$book); // add cac doi tuong cua book vao array lsbook
            }
        }
        // dong ket noi
        $con->close();
      //  mysqli_close();
      return $lsBook;
    }
    
    static function getListSearch($search=null)
    {
        $data = file("data/book.txt", FILE_SKIP_EMPTY_LINES);
        $arrBook = [];
        foreach ($data as $key => $value) {
            $row = explode("#", $value);
            if (
                strlen(strstr($row[0], $search)) || strlen(strstr($row[3], $search)) ||
                strlen(strstr($row[1], $search)) || strlen(strstr($row[4], $search)) ||
                strlen(strstr($row[2], $search)) || $search == null
            )
                $arrBook[] = new Book($row[0], $row[1], $row[2], $row[3], $row[4]);
        }
        return $arrBook;
    }
    static function addToFile($id, $price, $title, $author, $year)
    {
        $data = file("data/book.txt");
        $check = true;
        foreach ($data as $key => $value) {
            if ($value[0] == $id) {
                $check = false;
            }
        }
        if ($check) {
            $myfile = fopen("data/book.txt", "a+") or die("Unable to open file!");
            $row = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;
            fwrite($myfile, "\n" . $row);
            fclose($myfile);
        }
    }
    static function removeByID($id)
    {
        $data = file("data/book.txt");
        $myfile = fopen("data/book.txt", "w");
        $arrBook = array();
        // lưu vào mảng
        foreach ($data as $key => $value) {
            $row = explode("#", $value);
            $content = null;
            if ($row[0] != $id) {
                $content = $row[0] . "#" . $row[1] . "#" . $row[2] . "#" . $row[3] . "#" . $row[4];
                array_push($arrBook, $content);
            }
        }
        $numItems = count($arrBook);
        $i = 0;
        //ghi vào file
        foreach ($arrBook as $key => $value) {
            $s = $value;
            $i++;
            if ($i === $numItems) {
                $s = trim($value);
            }
            fwrite($myfile, $s);
        }
        fclose($myfile);
    }
    static function editBook($id, $price, $title, $author, $year){
        Book::removeByID($id);
        Book::addToFile($id, $price, $title, $author, $year);
    }

    }
