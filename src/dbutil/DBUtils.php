<?php

/**
 * Summary of DBUtils
 */
class DBUtils{

    public function panic() {

        $dsn = "mysql:host=localhost;dbname=lott";
        try {
            $con = new PDO($dsn,"root","root");
            return $con;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function destroy(){
        $con = null;
    }

}
