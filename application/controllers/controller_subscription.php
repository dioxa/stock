<?php
class Controller_Subscription extends Controller
{

    function __construct()
    {
        $this->model = new Model_Subscription();
        $this->view = new View();
    }

    function action_index()
    {
        $this->model->subscribe($_POST["stock"]);
        header("Location: /");
    }
}
?>