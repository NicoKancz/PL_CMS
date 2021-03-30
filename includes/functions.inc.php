<?php

function makeDir($website, $id): string {
    $result = '';
    if(!empty($id)){
        $result = '/PL_CMS/' . $website . '?id=' . $id;
    }else{
        $result = '/PL_CMS/' . $website;
    }
    return $result;
}

function makeDirName($type, $data):string {
    return $data[$type . 'Name'];
}