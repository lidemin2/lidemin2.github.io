<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
        //cookie形式写成按照规格写的
     $str="PHPSESSID=dhusgpvl54om784bhgrao2l96n; REMEMBERME=QXBwQnVuZGxlXEVudGl0eVxVc2VyczpiR2xrWlcxcGJnPT06MTU3MjMzNTQwMToxMTdhNmY4YWIyMDU1MWUyMjJhZjc0ZWU4MDNiMDI3Y2I3MzgzOTllOWFmNjAxOGIwYzQ4ZTQxMzVlMjZhMjY5; sys_key=-OBRpNBLg9CFg7GZ8uRQG5Jz2lJllBk7w16";
       $str=str_replace('=',':',$str);
        $str= str_replace(';',',',$str);
       $array1= explode(',',$str);
        foreach($array1 as $k1=>$v1){
            $trarray=explode(':',$v1);
            foreach( $trarray as $k=>$v){
                if($k==0){
                    echo "'".$v."':";
                }
                elseif($k%2!=0){
                    echo "'".$v."',";
                }elseif($k%2==0){
                    echo "'".$v."':";
                }
            }
        }

        die();
        $res = new\Org\Util\MakeCode();
        $table_name = $_GET['table_name'];
        $table_schema = $_GET['table_schema'];
        $notes = '修改订单物流';
        $route = 'changeWuliu';
        $sql = "SELECT string_agg(column_name, ',') FROM information_schema.columns where table_schema=" . $table_schema . " and table_name=" . $table_name;
        $obj = $res->transformer($table_name);
        $obj = '$' . str_replace("'", "", "$obj");
        $sqlres = M()->query($sql);
        $str = $sqlres[0]['string_agg'];
        $array = explode(',', $str);
//生成修改的对象
        echo '<font color="red">生成编辑</font>';
        echo '<br>';
        echo $res->editall($obj, $str, $notes, $route);
        echo '<br>';
//生成添加
        echo '<font color="red">生成添加</font>';
        echo '<br>';
        echo $res->addall($obj, $str, $notes, $route);
        echo '<br>';
//生成删除
        echo '<font color="red">生成删除</font>';
        echo '<br>';
        echo $res->delall($obj, $str, $notes, $route);
//生成查询
        echo '<font color="red">生成查询</font>';
        echo '<br>';
        echo $res->delall($obj, $str, $notes, $route);
        echo '<br>';
        echo '<font color="red">生成实体</font>';
        echo '<br>';
//生成实体
        echo $res->makeEntityss($str);
        echo '<br>';
        echo '<font color="red">生成attrs类型的插入的字段</font>';
        echo '<br>';
        $array = explode(',', $str);
        $strnew = '';
        foreach ($array as $key => $v) {
            //生成3行
            echo "'" . $v . "',";
            if ($key % 3 == 0) {
                echo "<br>";
            }
            //生成查询插入的一行
            echo "'oi." . $v . "',";
        }
        echo $strnew;
        echo '<br>';
    }
    public function  testinterinfo()
    {
        //我要把所有重复性的工作，写成代码。进行执行。
        /*
         * 不光是代码生成，业务逻辑等等，想到的一切的话，尽量写成更简单的方法，进行测试。
         *  1。查看是否是所有的数据已经插入成功
         *  2.改变数据类型是否可以插入成功
         *  3.往数据库里面插入的数据要记得删除掉，以免快速的查找的时候显示的时候是不对的。
         *  4.是否可以把数据更加简单的进行测试
         *  5.测试一些逻辑
         *
         *
         */

    }

}