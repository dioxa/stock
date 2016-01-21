<?php
class Check
{
    function start()
    {
        require_once 'parser.php';
        require_once 'connect_db.php';

        $parser = new Parser();
        $stmt = $PDO->prepare('select tab.subname, tab.date from (select * from stock_info order by date desc) as tab group by subname');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_NUM);

        foreach($result as $row){
            if($row[1] != date(date("Y-m-d"))){
                $info = $parser->get_info($row[0]);
                $stmt = $PDO->prepare("INSERT INTO stock_info(subname, price, date) VALUES(:subname, :price, :date)");
                $stmt->bindParam(':subname', $info[1]);
                $stmt->bindParam(':price', $info[3]);
                $stmt->bindParam(':date', $info[4]);

                $stmt->execute();
            }
        }
    }
}
?>