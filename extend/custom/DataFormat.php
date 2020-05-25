<?php
namespace custom;
/**
 * 数据处理类
 * @package     tools_class
 * @author      楚羽幽 <Name_Cyu@Foxmail.com>
 */
final class DataFormat
{
    /**
     * 返回多层栏目
     * @param $data 操作的数组
     * @param int $pid 一级PID的值
     * @param string $html 栏目名称前缀
     * @param string $fieldPri 唯一键名，如果是表则是表的主键
     * @param string $fieldPid 父ID键名
     * @param int $level 不需要传参数（执行时调用）
     * @return array
     */
    static public function channelLevel($data, $pid = null, $fieldPri = 'path', $fieldPid = 'spath', $level = 1){
        if (empty($data)) {
            return array();
        }
        $arr = array();
        foreach ($data as $v) {
            if ($v[$fieldPid] == $pid) {
                $arr[$v[$fieldPri]] = $v;
                $arr[$v[$fieldPri]]['_level'] = $level;
                $arr[$v[$fieldPri]]["_children"] = self::channelLevel($data, $v[$fieldPri], $fieldPri, $fieldPid, $level + 1);
            }
        }
        return $arr;
    }
}