<?php
/*---------------------------------------------------------------------
 * 应用的公共的常用的全局函数
 * ---------------------------------------------------------------------
 * Copyright (c) 2013-now http://blog518.com All rights reserved.
 * ---------------------------------------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------------------------------------
 * Author: <yangjian102621@gmail.com>
 *-----------------------------------------------------------------------*/

if (!function_exists('arrayGroup')) {
    /**
     * 将数组分组重新组合， 必须是 key => value 数组
     * @param $array
     * @param $groupKey 分组key
     * @return array
     */
    function arrayGroup($array, $groupKey) {
        $tmpArray = array();
        foreach($array as $value) {
            $tmpArray[$value[$groupKey]][] = $value;
        }

        return $tmpArray;
    }
}

if (!function_exists('genPassword')) {

    /**
     * 生成密码
     * @param $password 密码明文
     * @param $salt 密码盐
     * @return string
     */
    function genPassword($password, $salt) {
        return md5(md5($password.$salt));
    }
}

if (!function_exists('arrs2arr')) {

    /**
     * 二维数组转成一维数组
     * @param $array 二维数组
     * @param $key 二维数组键为key的值作为新数组的键
     * @param $value 二维数组键为value的值作为新数组的值
     * @return $temp 一维数组
     */
    function arrs2arr($array, $key, $value) {
        $temp = array();
        foreach ($array as $v) {
            $temp[$v[$key]] = $v[$value];
        }
        return $temp;
    }
}