<?php 
// 1. register new member
$users->dummyRegister($newuser, $sponsor, $upline, $position);
// 2. update upline
$users->dummyUpdateUpline($newuser, $upline, $position);

// 3. create donwline structure of binary tree
$level = 0;
$memberid = $newuser;
do{
	$getdata=$users->dummyGetUpline($memberid); 
	$uplne=$getdata[2]; 
	$posi=$getdata[3];

	$level++;
	if($uplne!==''){
		$users->dummyInsert_NetDownline($newuser, $uplne, $posi, $level);
	}
	$memberid=$uplne;
}
while($memberid!='');




//	Class User

class Users{

        private $db;
        public function __construct($database) {
            $this->db = $database;
        }   
    public function dummyRegister($username, $sponsor, $upline, $position, $today){

            $query  = $this->db->prepare("INSERT INTO `member` (`username`, `sponsor`, `upline`, `position`, `entry_date` ) VALUES (?, ?, ?, ?, ?) ");          
            $query->bindValue(1, $username);
            $query->bindValue(2, $sponsor);
            $query->bindValue(3, $upline);
            $query->bindValue(4, $position);
            $query->bindValue(5, $today);

            try{
                $query->execute();
             }catch(PDOException $e){
                die($e->getMessage());
            }   
        }


    public function dummyUpdateUpline($username, $upline, $position){

            if ($position=='left') {
            	$query  = $this->db->prepare("UPDATE `member` SET `_left`=? WHERE username=? ");
            }elseif ($position=='right') {
            	$query  = $this->db->prepare("UPDATE `member` SET `_right`=? WHERE username=? ");
            }

            $query->bindValue(1, $username);
            $query->bindValue(2, $upline);

            try{
                $query->execute();

            }catch(PDOException $e){
                die($e->getMessage());
            }   
        }

    public function dummyGetUpline($newuser) {// for demo

            $query = $this->db->prepare("SELECT * FROM `member` WHERE `username`= ?");
            $query->bindValue(1, $newuser);

            try{
                $query->execute();
                $rows = $query->fetch();

                return $rows;//['upline'];

            } catch(PDOException $e){
                die($e->getMessage());
            }
        }

    public function dummyInsert_NetDownline($newuser, $upline, $posi, $level){// for demo

            $query  = $this->db->prepare("INSERT INTO `net_downline` (`username`, `upline`, `position`, `level` ) VALUES (?, ?, ? ,?) ");
            $query->bindValue(1, $newuser);
            $query->bindValue(2, $upline);
            $query->bindValue(3, $posi);
            $query->bindValue(4, $level);

            try{
                $query->execute();

            }catch(PDOException $e){
                die($e->getMessage());
            }   
        }   

    }// endclass
?>