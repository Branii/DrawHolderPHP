<?php
include "config.php";
/**
 * Summary of DBUtils
 */
class DBUtils{

    public function panic() {

        try {
            $con = new PDO(SOURCE,USERNAME,PASSWORD);
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
