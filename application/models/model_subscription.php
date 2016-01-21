<?php
class Model_Subscription extends Model
{

    public function subscribe($subname)
    {
        include 'application/core/connect_db.php';

        $stmt = $PDO->prepare('SELECT * FROM stocks WHERE subname=:sub ');
        $stmt->bindParam(':sub', $subname);
        $stmt->execute();

        $numrows = $stmt->rowCount();

        if($numrows == 1){
            $this->update($subname);
        } else {
            $this->adding($subname);
            $this->update($subname);
        }
        $PDO = null;
    }



    function adding($subname)
    {
        require_once 'application/core/parser.php';
        include 'application/core/connect_db.php';

        $parser = new Parser();

        $info = $parser->get_info($subname);

        $stmt = $PDO->prepare("INSERT INTO stocks(name, subname, market) VALUES (:name, :subname, :mark);INSERT INTO stock_info(subname, price, date) VALUES(:subname, :price, :date)");
        $stmt->bindParam(':name', $info[0]);
        $stmt->bindParam(':subname', $info[1]);
        $stmt->bindParam(':mark', $info[2]);
        $stmt->bindParam(':price', $info[3]);
        $stmt->bindParam(':date', $info[4]);

        $stmt->execute();

        $PDO = null;
    }

    function update($subname){
        include 'application/core/connect_db.php';
        $stmt = $PDO->prepare("INSERT INTO subscriptions(user_id, stock_subname) VALUES(:id, :sub)");
        $stmt->bindParam(':id', $_SESSION["id"]);
        $stmt->bindParam(':sub', $subname);

        $stmt->execute();
        $PDO = null;
    }

}
?>