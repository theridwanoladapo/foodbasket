<?php 
function downline_number($member,$position) {

$query  = $this->db->prepare("SELECT * FROM `member` WHERE `upline`='$member' AND `position`='$position'");
        $query->bindValue(1, $member);
        $query->bindValue(2, $position);

try{
        $query->execute();
        $rows = $query->fetch();

        if($this->count_downline($member,$position) >0 ){
        $total=$this->total_members_down($rows['username']);
        }else{
        $total=0;
        }

        return $total;      

        }catch(PDOException $e){
            die($e->getMessage());
        }   

    }   

function count_downline($member,$position) {

$query  = $this->db->prepare("SELECT * FROM `member` WHERE `upline`=? AND `position`=? ");
        $query->bindValue(1, $member);
        $query->bindValue(2, $position);
    try{
        $query->execute();
        return $rows = $query->rowCount();

        }catch(PDOException $e){
            die($e->getMessage());
        }   
    }   

function total_members_down($upline,$reset=0) {
global $num;
if ($reset==0) { $num=1; }

$query  = $this->db->prepare("SELECT * FROM `member` where `upline`='$upline' order by id asc");
        $query->bindValue(1, $upline);
try{

$query->execute();

if ($upline !='') {

            if ($this->total_down($upline) > 0 ) {
                    while ($rows = $query->fetch() ) {
                    $num++;
                    $this->total_members_down($rows['username'],$num);
                    } 
                    return $num;
            } else { 
            return $num;
            }
} else { $num=0; return $num;  }            

     }catch(PDOException $e){
            die($e->getMessage());
        }   
}   

function total_down($upline) {

$query  = $this->db->prepare("SELECT * FROM `member` where `upline`='$upline' order by id asc ");
        $query->bindValue(1, $upline);

    try{
        $query->execute();
        return $rows = $query->rowCount();

        }catch(PDOException $e){
            die($e->getMessage());
        }   
    }   

?>