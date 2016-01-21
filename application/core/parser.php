<?php
class Parser
{

    public function parse($name, $start, $finish)
    {
        $position = strpos($name, $start);

        $name = substr($name, $position);
        $position = strpos($name, $finish);

        $name = substr($name, 0, $position);
        $name = strip_tags($name);

        return $name;
    }

    function get_info($subname)
    {
        $url = 'http://finance.yahoo.com/q?s=' . $subname;

        $start = '<div class="title"><h2>';
        $finish = '</span> <span class=';
        $content = file_get_contents($url);
        $position = strpos($content, $start);

        $content = substr($content, $position);
        $position = strpos($content, $finish);
        $content = substr($content, 0, $position);

        $info[] = substr($this->parse($content, '<div class="title"><h2>', '</h2> <span class="rtq_exch">'), 0, -6);
        $info[] = strtoupper($subname);
        $info[] = substr($this->parse($content, '<span class="rtq_dash">-</span>', '</span><span class="wl_sign">'), 1);
        $info[] = $this->parse($content, '<div> <span class="time_rtq_ticker">', '</span>');
        $info[] = date("Y-m-d");

        return $info;
    }

}