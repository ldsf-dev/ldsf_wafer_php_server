<?php
require_once "application/controllers/email.class.php";

/**
 * 礼待四方 - 后台管理接口
 * User: jumpo
 * Date: 2017/3/16
 * Time: 0:22
 */
class Admin extends CI_Controller
{
    /**
     * 访问后台管理页面
     */
    public function index()
    {
        $this->load->view('admin_index');
    }

    /**
     * 列出全部用户资料
     */
    public function allprofiles()
    {
        $this->load->model('Admin_model');

        $arr = $this->Admin_model->getUserProfiles();

        $this->load->view('admin_userlist', array('arr' => $arr));
    }

    /**
     * 列出全部用户登录记录
     */
    public function allloginrecords()
    {
        $this->load->model('Admin_model');

        $arr = $this->Admin_model->getUserLoginRecords();

        $this->load->view('admin_userlogins', array('arr' => $arr));
    }

    /**
     * 列出全部商品信息
     */
    public function allgoods()
    {
        $this->load->model('Admin_model');

        $arr = $this->Admin_model->getGoods();

        $this->load->view('admin_goodlist', array('arr' => $arr));
    }

    /**
     * 列出单个商品详细信息
     */
    public function gooddetail($id)
    {
        $this->load->model('Admin_model');

        $arr = $this->Admin_model->getGoodDetail($id);

        $this->load->view('admin_gooddetail', array('arr' => $arr));

    }

    /**
     * 上传永久媒体素材页面
     */
    public function newmedia()
    {
        $this->load->model('Admin_model');

        $this->load->view('admin_uploadpermanentmedia');

    }

    /**
     * 分日期订单更新页面
     */
    public function updatedelibydate()
    {
        $arr_title = array('title' => '礼待四方 - 分日期订单更新');

        $this->load->view('component/html_header');
        $this->load->view('component/head_header');
        $this->load->view('component/head_meta');
        $this->load->view('component/head_title', array('arr' => $arr_title));
        $this->load->view('component/head_style');
        $this->load->view('component/head_script_cardlist');
        $this->load->view('component/head_tcal');
        $this->load->view('component/head_script_setdefaultdatevalue');
        $this->load->view('component/head_footer');
        $this->load->view('component/body_header');
        $this->load->view('component/body_returntoindex');
        $this->load->view('admin_updatedelibydate');
        $this->load->view('component/body_footer');
        $this->load->view('component/html_footer');

    }

    /**
     * 列出所有卡券详细信息
     */
    public function allcards($currentpage, $pagelimit = 10)
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $post = file_get_contents("php://input");

        if ($post != '') {
            $arr_post = urldatatoarray($post);
            $redirectpage = $arr_post['redirectpage'] == '' ? '1' : $arr_post['redirectpage'];
            $arr = $this->Card_model->getAllCardsPaging($redirectpage, $pagelimit);
        } else {
            $arr = $this->Card_model->getAllCardsPaging($currentpage, $pagelimit);
        }

        $arr_title = array('title' => '礼待四方 - 卡券列表');

        $arr_paging = array(
            'url' => '/admin/allcards',
            'currentpage' => $arr['currentpage'],
            'pagecount' => $arr['pagecount'],
            'pagelimit' => $pagelimit,
            'pagearr' => $arr['pagearr']
        );

        $this->load->view('component/html_header');
        $this->load->view('component/head_header');
        $this->load->view('component/head_meta');
        $this->load->view('component/head_title', array('arr' => $arr_title));
        $this->load->view('component/head_style');
        $this->load->view('component/head_script_cardlist');
        $this->load->view('component/head_footer');
        $this->load->view('component/body_header');
        $this->load->view('component/body_returntoindex');
        $this->load->view('component/body_paging', array('arr' => $arr_paging));
        $this->load->view('admin_cardlistpaging', array('arr' => $arr));
        $this->load->view('component/body_footer');
        $this->load->view('component/html_footer');

    }

    /**
     * 列出所有卡券提货信息
     */
    public function alldeliverys($currentpage, $pagelimit = 10)
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $post = file_get_contents("php://input");

        if ($post != '') {
            $arr_post = urldatatoarray($post);
            $redirectpage = $arr_post['redirectpage'] == '' ? '1' : $arr_post['redirectpage'];
            $arr = $this->Card_model->getAllCardDeliveryInfoPaging($redirectpage, $pagelimit);
        } else {
            $arr = $this->Card_model->getAllCardDeliveryInfoPaging($currentpage, $pagelimit);
        }

        $arr_title = array('title' => '礼待四方 - 卡券提货列表');

        $arr_paging = array(
            'url' => '/admin/alldeliverys',
            'currentpage' => $arr['currentpage'],
            'pagecount' => $arr['pagecount'],
            'pagelimit' => $pagelimit,
            'pagearr' => $arr['pagearr']
        );

        $this->load->view('component/html_header');
        $this->load->view('component/head_header');
        $this->load->view('component/head_meta');
        $this->load->view('component/head_title', array('arr' => $arr_title));
        $this->load->view('component/head_style');
        $this->load->view('component/head_script_delilist');
        $this->load->view('component/head_footer');
        $this->load->view('component/body_header');
        $this->load->view('component/body_returntoindex');
        $this->load->view('component/body_paging', array('arr' => $arr_paging));
        $this->load->view('admin_delilist', array('arr' => $arr));
        $this->load->view('component/body_footer');
        $this->load->view('component/html_footer');

    }

    /**
     * 列出卡券提货信息（条件：提货日期）
     */
    public function selectdeliverysbydelidate($currentpage, $pagelimit = 10, $delidate = '')
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $post = file_get_contents("php://input");

        if ($post != '') {
            $arr_post = urldatatoarray($post);
            $redirectpage = $arr_post['redirectpage'] == '' ? '1' : $arr_post['redirectpage'];
            $arr = $this->Card_model->getCardDeliveryInfoPagingWithCondition(
                $redirectpage,
                $pagelimit,
                array(
                    't_card_deli.card_deli_expectdate' => $delidate
                )
            );
        } else {
            $arr = $this->Card_model->getCardDeliveryInfoPagingWithCondition(
                $currentpage,
                $pagelimit,
                array(
                    't_card_deli.card_deli_expectdate' => $delidate
                )
            );
        }

        $arr_title = array('title' => '礼待四方 - 卡券提货列表');

        $arr_paging = array(
            'url' => '/admin/alldeliverys',
            'currentpage' => $arr['currentpage'],
            'pagecount' => $arr['pagecount'],
            'pagelimit' => $pagelimit,
            'pagearr' => $arr['pagearr']
        );

        $this->load->view('component/html_header');
        $this->load->view('component/head_header');
        $this->load->view('component/head_meta');
        $this->load->view('component/head_title', array('arr' => $arr_title));
        $this->load->view('component/head_style');
        $this->load->view('component/head_script_delilist');
        $this->load->view('component/head_script_clipboardtool');
        $this->load->view('component/head_footer');
        $this->load->view('component/body_header');
        $this->load->view('admin_delilist_selectdelidate', array('arr' => $arr));
        $this->load->view('component/body_footer');
        $this->load->view('component/html_footer');

    }

    /**
     * 列出所有订单信息
     */
    public function allorders($currentpage, $pagelimit = 10)
    {
        $this->load->helper('myutil');
        $this->load->model('Order_model');

        $post = file_get_contents("php://input");

        if ($post != '') {
            $arr_post = urldatatoarray($post);
            $redirectpage = $arr_post['redirectpage'] == '' ? '1' : $arr_post['redirectpage'];
            $arr = $this->Order_model->getAllOrders($redirectpage, $pagelimit);
        } else {
            $arr = $this->Order_model->getAllOrders($currentpage, $pagelimit);
        }

        $arr_title = array('title' => '礼待四方 - 订单列表');

        $arr_paging = array(
            'url' => '/admin/allorders',
            'currentpage' => $arr['currentpage'],
            'pagecount' => $arr['pagecount'],
            'pagelimit' => $pagelimit,
            'pagearr' => $arr['pagearr']
        );

        $this->load->view('component/html_header');
        $this->load->view('component/head_header');
        $this->load->view('component/head_meta');
        $this->load->view('component/head_title', array('arr' => $arr_title));
        $this->load->view('component/head_style');
        $this->load->view('component/head_script_delilist');
        $this->load->view('component/head_footer');
        $this->load->view('component/body_header');
        $this->load->view('component/body_returntoindex');
        $this->load->view('component/body_paging', array('arr' => $arr_paging));
        $this->load->view('admin_orderlist', array('arr' => $arr));
        $this->load->view('component/body_footer');
        $this->load->view('component/html_footer');

    }

    /**
     * 添加单个商品详细信息
     */
    public function newgood()
    {
        $this->load->model('Admin_model');

        $arr = array(
            '商品编号|good_id',
            '分类编号|good_cat_id',
            '序号|good_cat_inner_seq',
            '商品类别|good_type',
            '商品名称|good_name',
            '商品描述|good_desc',
            '价格|good_price',
            '商品状态|good_status',
            '上架时间|good_onsale_datetime',
            '下架时间|good_offsale_datetime',
            '缩略图|good_thumbnail',
            '分类1|good_class_1',
            '分类2|good_class_2',
            '分类3|good_class_3',
            '分类4|good_class_4',
            '分类5|good_class_5',
        );

        $this->load->view('admin_newgood', array('arr' => $arr));

    }

    /**
     * 插入单个商品详细信息
     */
    public function setgooddetail()
    {
        $this->load->helper('myutil');
        $this->load->model('Admin_model');

        $post = urldatatoarray(file_get_contents("php://input"));

        $arr = array(
            'good_id' => $post['good_id'],
            'good_cat_id' => $post['good_cat_id'],
            'good_cat_inner_seq' => $post['good_cat_inner_seq'],
            'good_type' => $post['good_type'],
            'good_name' => $post['good_name'],
            'good_desc' => $post['good_desc'],
            'good_price' => $post['good_price'],
            'good_status' => $post['good_status'],
            'good_onsale_datetime' => $post['good_onsale_datetime'],
            'good_offsale_datetime' => $post['good_offsale_datetime'],
            'good_thumbnail' => $post['good_thumbnail'],
            'good_class_1' => $post['good_class_1'],
            'good_class_2' => $post['good_class_2'],
            'good_class_3' => $post['good_class_3'],
            'good_class_4' => $post['good_class_4'],
            'good_class_5' => $post['good_class_5'],
        );

        echo $this->Admin_model->updateGoodDetail($arr);
        var_dump($arr);

    }

    /**
     * 列出单个商品详细信息
     */
    public function setnewgood()
    {
        $this->load->helper('myutil');
        $this->load->model('Admin_model');

        $post = urldatatoarray(file_get_contents("php://input"));

        $arr = array(
            'good_id' => $post['good_id'],
            'good_cat_id' => $post['good_cat_id'],
            'good_cat_inner_seq' => $post['good_cat_inner_seq'],
            'good_type' => $post['good_type'],
            'good_name' => $post['good_name'],
            'good_desc' => $post['good_desc'],
            'good_price' => $post['good_price'],
            'good_status' => $post['good_status'],
            'good_onsale_datetime' => $post['good_onsale_datetime'],
            'good_offsale_datetime' => $post['good_offsale_datetime'],
            'good_thumbnail' => $post['good_thumbnail'],
            'good_class_1' => $post['good_class_1'],
            'good_class_2' => $post['good_class_2'],
            'good_class_3' => $post['good_class_3'],
            'good_class_4' => $post['good_class_4'],
            'good_class_5' => $post['good_class_5'],
            'good_status' => '1'
        );

        echo $this->Admin_model->insertNewGood($arr);
        var_dump($arr);

    }

    /**
     * 更新卡券提货订单的物流编号
     */
    public function updatedeliexpressno()
    {
        $this->load->helper('myutil');
        $this->load->model('Admin_model');

        $post = urldatatoarray(file_get_contents("php://input"));

        var_dump($post);

        echo $this->Admin_model->updateExpressNo($post);

    }

    /**
     * 从阿里云API接口获得最新省市区信息
     */
    public function getareainfofromapi()
    {
        $this->load->model('Area_model');
        $host = "http://jisuarea.market.alicloudapi.com";
        $path = "/area/all";
        $method = "GET";
        $appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "";
        $bodys = "";
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $areainfo = json_decode(curl_exec($curl), true);
        echo $this->Area_model->updateAreaInfo($areainfo);
    }

    /**
     * 通过微信API接口上传媒体素材（永久）
     */
    public function uploadpermanentmedia()
    {
        $this->load->helper('myutil');
        //$post = urldatatoarray(file_get_contents("php://input"));

        $file = $_FILES['media'];

        $token = getAccessToken();

        $real_path = $file['tmp_name'];
        //$real_path = '/data/savedfile/qrcode/qrcode_0000000072.jpg';

        $real_file = new CURLFile(realpath($real_path), 'image/jpeg', $file['name']);

        $file_info['filename'] = $file['name'];
        $file_info['content-type'] = 'image/jpeg';
        $file_info['filelength'] = $file['size'];

        $data['media'] = $real_file;
        $data['form-data'] = http_build_query($file_info);

        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=image";

        //var_dump($_FILES);
        //var_dump($data);

        echo https_request($url, $data);
        //echo file_exists($real_path);

    }

    public function getkflist()
    {
        $this->load->helper('myutil');
        $token = getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=$token";

        $json = https_request($url);

        echo $json;
    }

    /**
     * 通过微信API接口获取永久图片素材列表
     */
    public function getmaterialslist($type)
    {
        $this->load->helper('myutil');
        $token = getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$token";

        $arr = array(
            'type' => $type,
            'offset' => 0,
            'count' => 20,
        );

        $json = https_request($url, json_encode($arr));

        $arr_json = json_decode($json, true);

        $count = $arr_json['total_count'];

        $times = $count / 20;

        $arr_para = $arr_json['item'];

        for ($i = 1; $i < $times; $i++) {

            $arr = array(
                'type' => $type,
                'offset' => $i * 20,
                'count' => 20,
            );

            $json = https_request($url, json_encode($arr));
            $arr_json = json_decode($json, true);

            $arr_para = array_merge($arr_para, $arr_json['item']);
        }

        $this->load->view('admin_' . $type . 'materials', array('arr' => $arr_para));
    }

    public function getencmessage()
    {
        $pc = new WXBizMsgCrypt('lidaisifang2016', 'bYNWDwByz5PEt4t8q3WZeereQZ1Ri3ImrfY7oYftPoC', 'wxb0f5b379a85374ce');

        $xml_tree = new DOMDocument();
        $xml_tree->loadXML(file_get_contents("php://input"));
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $array_s = $xml_tree->getElementsByTagName('MsgSignature');
        $encrypt = $array_e->item(0)->nodeValue;
        $msg_sign = $array_s->item(0)->nodeValue;

        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);

// 第三方收到公众号平台发送的消息
        $msg = '';
        $errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
        if ($errCode == 0) {
            print("解密后: " . $msg . "\n");
        } else {
            print($errCode . "\n");
        }

        //echo file_get_contents("php://input");
    }

    public function sendmail()
    {

        //******************** 配置信息 ********************************
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport = 25;//SMTP服务器端口
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

        $smtpusermail = "jumponline@163.com";//SMTP服务器的用户邮箱
        $smtpuser = "jumponline@163.com";//SMTP服务器的用户帐号(或填写new2008oh@126.com，这项有些邮箱需要完整的)
        $smtppass = "cr2032";//SMTP服务器的用户密码

        //$smtpemailto = "22216962@qq.com";//发送给谁
        //$mailtitle = $_POST['title'];//邮件主题
        //$mailcontent = "<h1>" . $_POST['content'] . "</h1>";//邮件内容
        $smtpemailto = $_POST['toemail'];//发送给谁
        $mailtitle = "My title at " . date("Y-m-d H:i:s");//邮件主题
        $mailcontent = "<h1>" . "E-mail Content" . "</h1>";//邮件内容

        //************************ 配置信息 ****************************
        $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

        if ($state == "") {
            echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
        }
        echo "恭喜！邮件发送成功！！";
    }

    public function sendmessagetosupplier()
    {
        $this->load->helper('myutil');

        $token = getAccessToken();

        $data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"awC-pnebafLCpeqCzx6Q741xBnUH9rKowjouWmzc0WE","url":"https://64458061.gift4fang.com/admin/selectdeliverysbydelidate/1/200/2017-10-22","data":{"first":{"value":"购买成功！","color":"#173177"},"keyword1":{"value":"您购买了一个商品","color":"#173177"},"keyword2":{"value":"平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06","color":"#173177"},"remark":{"value":"平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06","color":"#173177"}}}';
        $ret = https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token", $data);

        echo $ret;
    }


    public function testredirect()
    {
        var_dump($_SERVER);
    }
}