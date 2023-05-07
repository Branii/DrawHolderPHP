<?php
session_start();
include "../model/DrawClass.php";

/**
 * Summary of DrawNumberClass
 */
class DrawNumberClass extends DBUtils{

    
    private $model;

    /**
     * Summary of generateDrawNumbesr
     * @param mixed $drawTime
     * @param mixed $drawPeriod
     * @return void
     */
    public function generateDrawNumber($drawTime) : string {

        // generate numbers
        $numArr = array(0,1,2,3,4,5,6,7,8,9);
        shuffle($numArr);
       // print_r($numArr);
        $drawNumber = $numArr[0] . "," . $numArr[1] . "," . $numArr[2] . "," . $numArr[3] . "," . $numArr[4];

        //generate drawPeriod
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $expl = explode(":",$time);
        $currHour = $expl[0];
        $currMinute = $expl[1];
        $drawCount = $currHour * 60 + $currMinute - 59;
        $drawPeriod = date("Ymd") . sprintf("%04d", $drawCount);

        //insert into drawTAble
        $sql = "INSERT INTO drawTable (drawTime, drawDate, drawPeriod, drawNumber, drawState) VALUES (?,?,?,?,?)";
        $stmt = self::panic()->prepare($sql);
        $stmt->bindParam(1,$drawTime,PDO::PARAM_STR);
        $stmt->bindParam(2,$date,PDO::PARAM_STR);
        $stmt->bindParam(3,$drawPeriod,PDO::PARAM_STR);
        $stmt->bindParam(4,$drawNumber,PDO::PARAM_STR);
        $stmt->bindParam(5,$drawState,PDO::PARAM_STR);
        if($stmt->execute()){
        //get current drawPeriod | drawNumber 
        $_SESSION['drawPeriod'] = $drawPeriod;
        $_SESSION['drawNumber'] = $drawNumber;

        $this->model = new DrawClass;
        $this->model->generateWinOrLoss();
        $this->model->generateUserBets();
        return "DrawNumer: => " . $drawNumber . " DrawPeriod: => " . sprintf("%04d", $drawCount);
        }

    }
}