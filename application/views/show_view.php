<?php
class Show_view
{
    function generate($data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        foreach ($data as $st) {
            echo '<div class = "subblock">';
            foreach ($st as $row) {
                echo $row . '      ';
            }
            echo '</div>';
        }
    }
}
?>