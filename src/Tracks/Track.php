<?php

class Track
{
    public function download_track( $url ){

        $url = str_replace("p:","ps:", $url);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$url."\"");
        readfile($url);
        exit;
    }

}