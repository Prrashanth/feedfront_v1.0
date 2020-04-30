<?php

class Main extends CI_Controller {

    public function index() {
        $f = fopen("date.csv", "r");
        $res = [];
        while ($row = fgetcsv($f)) {
//            var_dump($row);
            if ($row[0] != '29/11/2019') {
                $res[] = $row[0];
            }
        }
        fclose($f);
        var_dump($res);
        $file = fopen("date.csv", "w+");
        for($i=0;$i<count($res);$i++)
        {
            fputcsv($file,array($res[$i]));
        }
        fclose($file);
    }

}
