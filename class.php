<?php
    class Database{
        protected $host = 'localhost';
        protected $db = 'fixmoto';
        protected $user = 'root';
        protected $pass = '';
        public function db_con(){
            $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
            $conn -> set_charset("utf8");
            if ($conn->connect_error) {
                return die("Connection failed: " . $conn->connect_error);
            }else {
                return $conn;
            }
        }
    }
    class Main extends Database{
        public function getDatacus($monumber){
            $data[] = [];
            $sql = "SELECT customer_id , f_name , l_name , mobile_num FROM customer WHERE mobile_num = $monumber";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function addFixlist($customerID , $plate , $brand , $fix_detail){
            $d = strtotime("tomorrow");
            $datenow = date("Y-m-d h:i:sa", $d);
            $sql = "INSERT INTO `fix_list` (`fix_id`, `customer_id`, `date`, `brand`, `fix_detail`, `fix_status_id`, `plate`) VALUES (NULL, '$customerID', '$datenow', '$brand', '$fix_detail', '1', '$plate')";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function addnewCus($monumber , $f_name , $l_name){
            $sql = "INSERT INTO customer (customer_id , f_name , l_name , mobile_num) 
            VALUES (NULL , '$f_name' , '$l_name' , '$monumber')
            ";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function getLastcus(){
            $sql = "SELECT max(customer_id) FROM customer";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['max(customer_id)'];
            }
            return $data;
        }
        public function showFixlist(){
            $sql = "SELECT fix_id , customer_id , date , brand , fix_detail , fix_status_id , plate FROM fix_list";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function getNamebyfixid($fix_id){
            $sql = "SELECT customer.f_name , customer.l_name FROM fix_list INNER JOIN customer on fix_list.customer_id = customer.customer_id WHERE fix_list.fix_id = $fix_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function getStatusbyfixid($fix_id){
            $sql = "SELECT fix_status.fix_detail FROM `fix_list`
            INNER JOIN fix_status on fix_list.fix_status_id = fix_status.fix_status_id WHERE fix_list.fix_id = $fix_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function showFixlistbyid($fix_id){
            $sql = "SELECT fix_id , customer_id , date , brand , fix_detail , fix_status_id , plate FROM fix_list WHERE fix_id = $fix_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
// add by old class..
        public function showProduct(){
            $data[] = [];
            $sql = "SELECT part_list.part_id, part_list.part_desc, part_list.part_cost, part_list.part_price, part_stock.part_total FROM part_list INNER JOIN part_stock ON part_list.part_id = part_stock.part_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function showBuyproduct($sup_id){
            $sql = "SELECT part_id, part_desc FROM part_list WHERE supplier_id = $sup_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function showBuyid(){
            $sql = "SELECT max(buy_id) FROM buy";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['max(buy_id)'];
            }
            return $data;
        }
        public function addProduct($supplier , $prod_desc , $prod_cost , $prod_price){
            $sql = "INSERT INTO `part_list` (`part_id`, `supplier_id`, `part_desc`, `part_cost`, `part_price`) VALUES (NULL, '$supplier', '$prod_desc', '$prod_cost', '$prod_price');";
            $sql3 = "SELECT max(part_id) FROM `part_list`";
            if($this->db_con()->query($sql)){
                $result3 = $this->db_con()->query($sql3);
                while($row3 = $result3->fetch_assoc()){
                    $data3 = $row3['max(part_id)'];
                }
                $sql2 = "INSERT INTO `part_stock` (`part_id`, `part_total`) VALUES ('$data3', '0')";
                if($this->db_con()->query($sql2)){
                    return 'เพิ่มเรียบร้อยแล้ว';
                }else {
                    return 'มีปัญหาขั้นตอนอัพเดท Stock';
                }
            }else{
                return 'มีปัญหา';
            }
        }
        public function showSupplier(){
            $data = [];
            $sql = "SELECT supplier_id , supplier_desc FROM supplier";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function addSupplier($name){
            $sql = "INSERT INTO supplier (supplier_desc) values ('$name')";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function addBuy($sup_id, $dateofbill, $dateofpay){
            $sql = "INSERT INTO `buy` (`buy_id`, `supplier_id`, `buy_date`, `buy_status_id`, `recv_date`, `due_pay_date`, `pay_date`) VALUES (NULL, '$sup_id', '$dateofbill', '1', NULL, '$dateofpay', NULL)";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function addBuydesc($buy_id , $part_id , $order_amount){
            $sql = "INSERT INTO `buy_desc` (`buydesc_id`, `part_id`, `buy_id`, `order_amount`, `recv_amount`) VALUES (NULL, '$part_id', '$buy_id', '$order_amount', NULL)";
            if($this->db_con()->query($sql)){
                return 'เพิ่มเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function listPo(){
            $data = [];
            $sql = "SELECT buy_id , supplier_desc , buy_date FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function listPoActivate(){
            $data = [];
            $sql = "SELECT buy_id , supplier_desc , buy_date FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id
            WHERE buy_status_id = 2";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function costPo($buy_id){
            $sql = "SELECT part_list.part_id , order_amount , part_list.part_cost 
            FROM buy_desc 
            INNER JOIN part_list on buy_desc.part_id = part_list.part_id 
            WHERE buy_id = $buy_id
            ";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            $costPo = 0;
            for($i = 0 ; count($data) > $i ; $i++){
                $costPo += ($data[$i]['order_amount'] * $data[$i]['part_cost']);
            }
            return $costPo;
        }
        public function getStatusPo($buy_id){
            $data = [];
            $sql = "SELECT buy_status_desc FROM `buy_status` INNER JOIN buy on buy.buy_status_id = buy_status.buy_status_id WHERE buy.buy_id = $buy_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['buy_status_desc'];
            }
            return $data;
        }
        public function getNameSupplier($buyid){
            $data = [];
            $sql = "SELECT supplier_desc FROM buy INNER JOIN supplier on buy.supplier_id = supplier.supplier_id WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['supplier_desc'];
            }
            return $data;
        }
        public function getDatebuy($buyid){
            $data = [];
            $sql = "SELECT buy_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['buy_date'];
            }
            return $data;
        }
        public function detailBill($buyid){
            $data = [];
            $sql = "SELECT buy_desc.part_id , part_list.part_desc , order_amount, (order_amount * part_list.part_cost)  FROM buy_desc INNER JOIN part_list on part_list.part_id = buy_desc.part_id WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function activateBill($buyid){
            $sql = "UPDATE buy SET buy_status_id = '2' WHERE buy_id = $buyid";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function payBill($buyid){
            $d = strtotime("tomorrow");
            $datenow = date("Y-m-d", $d);
            $sql = "UPDATE buy SET pay_date ='$datenow' WHERE buy_id = $buyid";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkPay($buyid){
            $sql = "SELECT pay_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['pay_date'];
            }
            if($data == NULL){
                return 0;
            }else {
                return 1;
            }
        }
        public function getPoStock($part_id){
            $total = 0;
            $sql = "SELECT part_total FROM part_stock WHERE part_id = $part_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $total = $row['part_total'];
            }
            return $total;
        }
        public function getProduct($part_id , $amount){
            $amount = $this->getPoStock($part_id) + $amount;
            $sql = "UPDATE part_stock SET part_total = '$amount' WHERE part_id = $part_id";
            
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function updateDateRecv($buy_id){
            $d = strtotime("tomorrow");
            $datenow = date("Y-m-d", $d);
            $sql = "UPDATE buy SET recv_date = '$datenow' WHERE buy_id = $buy_id";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkRecv($buyid){
            $sql = "SELECT recv_date FROM buy WHERE buy_id = $buyid";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['recv_date'];
            }
            if($data == NULL){
                return 0;
            }else {
                return 1;
            }
        }
        public function stockProduct(){
            $data = [];
            $sql = "SELECT product_stock.prod_id , product.prod_desc , branch.branch_name , branch.branch_location , total FROM `product_stock` INNER JOIN product on product_stock.prod_id = product.prod_id INNER JOIN branch on product_stock.branch_id = branch.branch_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function usePart($fix_id){
            $data = [];
            $sql = "SELECT part_desc , fix_use.part_number FROM `fix_use` INNER JOIN part_number on fix_use.part_number = part_number.part_number INNER JOIN part_list on part_number.part_id = part_list.part_id WHERE fix_id = $fix_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function addFixuse($partnumber , $fix_id){
            $sql = "INSERT INTO `fix_use` (`fix_id`, `part_number`, `fixuse_id`) VALUES ('$fix_id', '$partnumber', NULL)";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkPartuse($partnumber){
            $data[] = [];
            $sql = "SELECT part_number FROM `part_number` WHERE part_number = '$partnumber' and part_status != 'used'";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        public function setStatuspart($partnumber){
            $sql = "UPDATE `part_number` SET `part_status` = 'used' WHERE `part_number`.`part_number` = '$partnumber'";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function getPartID($partnumber){
            $sql = "SELECT part_id FROM part_number WHERE part_number = '$partnumber'";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['part_id'];
            }
            return $data;
        }
        public function getPartTotal($partnumber){
            $part_id = $this->getPartID($partnumber);
            $sql = "SELECT part_total FROM part_stock WHERE part_id = '$part_id'";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['part_total'];
            }
            return $data;
        }
        
        public function updateStockfixuser($partnumber){
            $part_id = $this->getPartID($partnumber);
            $part_total = $this->getPartTotal($partnumber) - 1;
            $sql = "UPDATE `part_stock` SET `part_total` = '$part_total' WHERE `part_stock`.`part_id` = $part_id";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
        public function checkStatusFix($fix_id){
            $sql = "SELECT fix_status.fix_detail FROM `fix_status` INNER JOIN fix_list on fix_list.fix_status_id = fix_status.fix_status_id WHERE fix_list.fix_id = $fix_id";
            $result = $this->db_con()->query($sql);
            while($row = $result->fetch_assoc()){
                $data = $row['fix_detail'];
            }
            return $data;
        }
        public function changeStatusFix($fix_id , $fix_status){
            $sql = "UPDATE `fix_list` SET `fix_status_id` = '$fix_status' WHERE `fix_list`.`fix_id` = $fix_id;";
            if($this->db_con()->query($sql)){
                return 'อัพเดทเรียบร้อยแล้ว';
            }else{
                return 'มีปัญหา';
            }
        }
    }
?>