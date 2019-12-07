<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller
{
    public function index()
    {
        $name=$_POST['name'];
        $age=$_POST['age'];
        //json 转数组
        $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
        var_dump(json_decode($json, true));

//        $res = new\Org\Util\MakeCode();
//        $table_name = $_GET['table_name'];
//        $table_schema = $_GET['table_schema'];
//        $notes = '修改订单物流';
//        $route = 'changeWuliu';
//        $sql = "SELECT string_agg(column_name, ',') FROM information_schema.columns where table_schema=" . $table_schema . " and table_name=" . $table_name;
//        $obj = $res->transformer($table_name);
//        $obj = '$' . str_replace("'", "", "$obj");
//        $sqlres = M()->query($sql);
//        $str = $sqlres[0]['string_agg'];
//        $array = explode(',', $str);
////生成修改的对象
//        echo '<font color="red">生成编辑</font>';
//        echo '<br>';
//        echo $res->editall($obj, $str, $notes, $route);
//        echo '<br>';
////生成添加
//        echo '<font color="red">生成添加</font>';
//        echo '<br>';
//        echo $res->addall($obj, $str, $notes, $route);
//        echo '<br>';
////生成删除
//        echo '<font color="red">生成删除</font>';
//        echo '<br>';
//        echo $res->delall($obj, $str, $notes, $route);
////生成查询
//        echo '<font color="red">生成查询</font>';
//        echo '<br>';
//        echo $res->delall($obj, $str, $notes, $route);
//        echo '<br>';
//        echo '<font color="red">生成实体</font>';
//        echo '<br>';
////生成实体
//        echo $res->makeEntityss($str);
//        echo '<br>';
//        echo '<font color="red">生成attrs类型的插入的字段</font>';
//        echo '<br>';
//        $array = explode(',', $str);
//        $strnew = '';
//        foreach ($array as $key => $v) {
//            //生成3行
//            echo "'" . $v . "',";
//            if ($key % 3 == 0) {
//                echo "<br>";
//            }
//            //生成查询插入的一行
//            echo "'oi." . $v . "',";
//        }
//        echo $strnew;
//        echo '<br>';  //cookie形式写成按照规格写的
//       $name= $_POST['name'];
//       $age= $_POST['age'];
//       var_dump($_POST);
        $data=array('code'=>200);
        echo json_encode($data);
    }
    public function test2(){
       $query= "INSERT INTO  courses ( `student`, `class`, `score`) VALUES ('C', 'lisid3dd', 22)";
        M()->query($query);
       // echo '123';
    }
}