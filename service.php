<?php

function carousel($params){
    if (!empty($params)){
        $count = count(json_decode($params));
        $arr = json_decode($params);
        if ($count > 1){
            $nil = '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
            $nil .= '<ol class="carousel-indicators">';
                foreach(json_decode($params) as $key=>$val){
                    $nil .= '<li data-target="#myCarousel" data-slide-to="'.$key.'" class="'.($key == 0 ? 'active' : '').'"></li>';
                }
            $nil .= '</ol>';
            $nil .= '<div class="carousel-inner">';
                foreach(json_decode($params) as $key=>$val){
                    $nil .= '<div class="item '.($key == 0 ? 'active' : '').'"><img src="file/'.$val.'" style="width:100%;"><div class="carousel-caption"><h4>'.$val.'</h4></div></div>';
                }
            $nil .= '</div>';
            $nil .= '<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
            $nil .= '<span class="glyphicon glyphicon-chevron-left"></span>';
            $nil .= '<span class="sr-only">Previous</span></a>';
            $nil .= '<a class="right carousel-control" href="#myCarousel" data-slide="next">';
            $nil .= '<span class="glyphicon glyphicon-chevron-right"></span>';
            $nil .= '<span class="sr-only">Next</span></a>';
            $nil .= '</div>';
        } else {
            $nil = '<img src="file/'.$arr[0].'" width="100%">';
        }
    } else {
        $nil = '<span class="label label-warning">gambar belum tersedia</span>';
    }
    return $nil;
}