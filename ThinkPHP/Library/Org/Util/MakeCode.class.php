<?php
namespace Org\Util;


class MakeCode
{
    /**
     * SearchBuilder constructor.
     * @param array $assoc
     * @param QueryBuilder $query
     * @param array $byval
     * @param array $existRule
     */
    public function __construct()
    {

    }

// 将驼峰变量和下划线风格的变量名互转
    function transformer($str = '')
    {
        if (!empty($str)) {
            $new_str = '';
            // 字串中是否含有 '_'
            if (strstr($str, '_')) {
                $arr = explode('_', $str);
                array_walk($arr, function (&$param, $key) {
                    $param = ucfirst($param);
                });
                $new_str = join('', $arr);
            } else {
                // 驼峰处理
                $str = lcfirst($str);
                $length = strlen($str);
                for ($i = 0; $i < $length; $i++) {
                    if ($str[$i] >= 'A' && $str[$i] <= 'Z') {
                        $new_str .= '_' . strtolower($str[$i]);
                    } else {
                        $new_str .= $str[$i];
                    }
                }
            }
            return $new_str;
        } else {
            return $str;
        }
    }

    public function ucword(&$param, $key)
    {
        $param = ucfirst($param);
    }

//print transformer('hello_world');


    function parse_name($name, $type = 0)
    {
        if ($type) {
            // 下划线转驼峰
            return ucfirst(
                preg_replace_callback('/_([a-zA-Z])/', function ($match) {
                    return strtoupper($match[1]);
                }, $name)
            );
        } else {
            // 驼峰转下划线
            return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
    }


    /**
     * @param $obj
     * @param $request
     * @param $notes 备注
     * @param $route 路由前面写驼峰
     */
    function makeCode($obj, $request)
    {
        echo '$' . "$request" . '= $request->get(' . "'$request'" . ',null);';
        echo '<br>';
        echo 'is_null(' . "$" . $request . ')?:' . $obj . '->set' . $this->transformer($request) . '(' . "$" . "$request" . ');';
        echo '<br>';


    }

    public function tou($notes, $route)
    {
        $oldRoute = $route;
        $route = $this->transformer($route);
        echo '/**';
        echo '<br>';
        echo '*' . $notes;
        echo '<br>';
        $slashRoute = str_replace("_", "/", $route);
        echo '@Route("/' . $slashRoute . '"' . "),name=" . '"' . $route . '"' . ")";
        echo '<br>';
        echo '*/';
        echo '<br>';
        echo 'public function ' . $oldRoute . '(Request' . ' ' . ' $request' . ')' . '{';
        echo '<br>';
    }

    /**
     * @param $obj
     * @param $request
     * @param $notes 备注
     * @param $route 路由前面写驼峰
     */
    function editall($obj, $str, $notes, $route)
    {
//         $obj='$orderShip';
//         // $str='harvester_receive_name,harvester_receive_mobile,harvester_receive_state,harvester_receive_city,harvester_receive_district,harvester_receive_address,report_receive_email,report_receive_name,report_receive_state,report_receive_city,report_receive_district,report_receive_address,report_receive_address,harvester_receive_email,harvester_default_report';
//       $obj='$order';
//        $str='shipping_name,shipping_code';
//     $notes='修改订单物流';
//     $route='changeWuliu';
        $array = explode(',', $str);
        $this->tou($notes, $route);
        foreach ($array as $k => $v) {
            $this->makeCode($obj, $v);
        }
        echo '$this->flush();';
        echo '<br>';
        echo '$this->suc([' . "'msg' => '修改成功']);";
        echo '<br>';
        echo '}';
    }
//editall();
///*
// * 生成setAll那种脚本
// */
//function editall2(){
//    $obj='$orderShip';
//    $str='harvester_receive_name,harvester_receive_mobile,harvester_receive_state,harvester_receive_city,harvester_receive_district,harvester_receive_address,report_receive_email,report_receive_name,report_receive_state,report_receive_city,report_receive_district,report_receive_address,report_receive_address,harvester_receive_email,harvester_default_report';
//    $array=explode(',',$str);
//    foreach($array as $k=>$v){
//        makeCode($obj,$v);
//    }
//    echo '$this->flush();';
//    echo '<br>';
//    echo '$this->suc(['."'msg' => '修改成功']);";
//    echo '<br>';
//}
    /*
     * 生成添加的
     */
    function addall($obj, $str, $notes, $route)
    {
        $this->tou($notes, $route);
        //$obj='$orderShip';
        echo " new $obj";
        //$str='harvester_receive_name,harvester_receive_mobile,harvester_receive_state,harvester_receive_city,harvester_receive_district,harvester_receive_address,report_receive_email,report_receive_name,report_receive_state,report_receive_city,report_receive_district,report_receive_address,report_receive_address,harvester_receive_email,harvester_default_report';
        $array = explode(',', $str);
        foreach ($array as $k => $v) {
            $this->makeCode($obj, $v);
        }
        echo '$this->flush();';
        echo '<br>';
        echo '$this->suc([' . "'msg' => '添加成功']);";
        echo '<br>';
    }


    /*
     * 生成删除
     */
    function delall($obj, $str, $notes, $route)
    {
        $this->tou($notes, $route);
        //$obj='$orderShip';
        echo " new $obj";
        //$str='harvester_receive_name,harvester_receive_mobile,harvester_receive_state,harvester_receive_city,harvester_receive_district,harvester_receive_address,report_receive_email,report_receive_name,report_receive_state,report_receive_city,report_receive_district,report_receive_address,report_receive_address,harvester_receive_email,harvester_default_report';
        $array = explode(',', $str);
        foreach ($array as $k => $v) {
            $this->makeCode($obj, $v);
        }
        echo '$this->flush();';
        echo '<br>';
        echo '$this->suc([' . "'msg' => '添加成功']);";
        echo '<br>';
    }

    public function  del()
    {
//        echo '/**';
//        echo '<br>';
//         * @Route("delete", name="dna_amount_delete")
//         * @Method("POST")
//         * @Security("has_role('ROLE_ADMIN')")
//         * @param Request $request
//         * @return \Symfony\Component\HttpFoundation\JsonResponse
//         */
//        public function deleteAction(Request $request)
//        {
//            $sample_code = $this->getSampleByCode($request);
//            $lib_prep = $this->findLibPrepByCode($sample_code);
//            if (!$lib_prep)
//                throw new EntityObjectNotFindException('样品DNA准备信息不存在');
//            $this->sample ? $this->sample->setSampleStatus(0) : $this->sampleInput->setSampleStatus(0);
//            $this->remove($lib_prep);
//            return $this->suc('DNA准备信息删除成功');
//        }
    }



///*
// * 生成permit
// */
    function makeEntity($request)
    {
        echo '/**';
        echo "</br>";
        echo '* @ORM\Column(type="string")';
        echo "</br>";
        echo ' */';
        echo "</br>";
        echo 'public' . ' ' . '$' . $request . ";";
        echo "</br>";
    }

    function  makeSetfuntcion($request)
    {
        echo '/**';
        echo "</br>";
        echo '*set' . ' ' . $request;
        echo "</br>";
        echo " @param string".' '.'$'.$request;
        echo "</br>";
         echo "@return string";
        echo "</br>";
        echo ' */';
        echo "</br>";
        echo 'public'.' '.'function'.' '. 'set'.$this->transformer($request).'('.'$'.$request.')';
        echo "</br>";
       echo "{";
       echo "</br>";
            echo ' '.'$this->'.$request= $request.";";
               echo "</br>";
    echo '  return $this;';
        echo "</br>";
        echo "}";
        echo "</br>";
    }
    function  makeGetfuntcion($request)
    {
        echo '/**';
        echo "</br>";
        echo '*get' . ' ' . $request;
        echo "</br>";
        echo "@return string";
        echo "</br>";
        echo ' */';
        echo "</br>";
        echo 'public'.' '.'function'.' '. 'get'.$this->transformer($request).'('.'$'.$request.')';
        echo "</br>";
        echo "{";
        echo "</br>";
        echo 'return  '.'$this->'.$request.';';
        echo "</br>";
        echo "}";
        echo "</br>";
    }



function makeEntityss($str){

    $array=explode(',',$str);
    foreach($array as $k=>$v){
      $this-> makeEntity($v);
    }

    foreach($array as $k=>$v){
        $this-> makeSetfuntcion($v);
        $this-> makeGetfuntcion($v);
    }
}
//test();

}