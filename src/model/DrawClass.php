<?php
include "../dbutil/DBUtils.php";
/**
 * Summary of DrawClass
 */
class DrawClass extends DBUtils{

    public function generateUserBets(){
        //sleep(5);
        //generate user bets
        for($x = 0; $x < 10; $x ++){
            $numArr = array(0,1,2,3,4,5,6,7,8,9);
            shuffle($numArr);
            $betNumber = $numArr[0] . "," . $numArr[1] . "," . $numArr[2] . "," . $numArr[3] . "," . $numArr[4];
            $betAmount = "GHc " . rand(1,100);
            $betPeriod = $_SESSION['drawPeriod'] + 1;
            $betDate = date("Y-m-d");
            $betTime = date("H:i:s");
            $betState = "pending";
            $betUser = "userId " . rand(1,10);
            $sql = "INSERT INTO betTable (betNumber, betAmount, betPeriod, betDate, betTime, betState, betUser) VALUES (?,?,?,?,?,?,?)";
            $stmt = self::panic()->prepare($sql);
            $stmt->bindParam(1,$betNumber,PDO::PARAM_STR);
            $stmt->bindParam(2,$betAmount,PDO::PARAM_STR);
            $stmt->bindParam(3,$betPeriod,PDO::PARAM_STR);
            $stmt->bindParam(4,$betDate,PDO::PARAM_STR);
            $stmt->bindParam(5,$betTime,PDO::PARAM_STR);
            $stmt->bindParam(6,$betState,PDO::PARAM_STR);
            $stmt->bindParam(7,$betUser,PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    public function generateWinOrLoss(){

        //check user win or lost
        $betState = "pending";
        $sql = "SELECT * FROM betTable WHERE betPeriod = ? AND betState = ?";
        $stmt = self::panic()->prepare($sql);
        $stmt->bindParam(1,$_SESSION['drawPeriod'],PDO::PARAM_STR);
        $stmt->bindParam(2,$betState,PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $betNumber = explode(",",$row['betNumber']);
            $drawNumber = explode(",",$_SESSION['drawNumber']);
            $count = 0;
            for($x = 0; $x < 5; $x ++){
                if($betNumber[$x] == $drawNumber[$x]){
                    $count ++;
                }
            }
            if($count == 5){
                $betState = "win";
                $sql = "UPDATE betTable SET betState = ? WHERE betid = ?";
                $stmt = self::panic()->prepare($sql);
                $stmt->bindParam(1,$betState,PDO::PARAM_STR);
                $stmt->bindParam(2,$row['betid'],PDO::PARAM_STR);
                $stmt->execute();
            }else{
                $betState = "lost";
                $sql = "UPDATE betTable SET betState = ? WHERE betid = ?";
                $stmt = self::panic()->prepare($sql);
                $stmt->bindParam(1,$betState,PDO::PARAM_STR);
                $stmt->bindParam(2,$row['betid'],PDO::PARAM_STR);
                $stmt->execute();
            }
        }

     

        

    }

}