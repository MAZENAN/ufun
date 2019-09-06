<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class GoodsModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'goods';
        $this->type = 1;
        $this->title = '商品';
        $this->istab = true;
        $this->tabsplit = false;
        $this->tabs = [
            'base'=>'基本信息',
            'attr'=>'商品属性',
            'kucun'=> '库存',
            'detail'=> '详情',
//            'delivery'=> '配送设置',
            'special'=>'促销优惠'
//            'qx'=>'购买权限',
//            'share'=>'分享关注',
//            'notify'=>'卖家通知'
        ];
        $this->btns_left = 1;
        $this->script = '$(function(){
            $("#merchant_id").change(
                function(){
                    $("#data_val_cate_id").attr(\'value\',"")
                    $("#cate_id_info").html("")
                    $("#cate_id_info").attr("class","field-info")
                    var var_arr = \'\'
                    var merchant_id = $(this).val()
                    if(merchant_id!=\'\'){
                        var url = "__APPROOT__/seller_menu/menus?mid="+merchant_id;
                        $.ajax(
                            {
                                url : url,
                                type : "get",
                                data : {},
                                async : true,
                                success : function(data) {
                                    data = JSON.parse(data);
                                    $("#cate_id").html(\'\');
                                    for(var i=0;i<data.length;i++)
                                    {
                                    var id = data[i].id
                                    var title = data[i].title
                                        $("#cate_id").append(\'<option class="btnget"  id="cate_id_\'+i+\'" name="cate_id" value="\'+id+\'" >\'+title+\'</option><label for="cate_id_\'+i+\'">\'+title+\'</label>\');
                                    }
                                }
                            }
                        )
                    }else{
                        $("#cate_id").html(\'\');
                    }
                }
            )
});';
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
            'title' => array(
                'label' => '商品名称',
                'label_width' => 150,
                'type' => 'text',
                'tab'=>'base',
                'tip_back' => '<span class="red">*</span>必填，用于给顾客展示',
                'data_val' => array(
                    'required'=>true
                ),
                'data_val_msg' => array(
                    'required'=>'商品名不能为空'
                ),
            ),
            'short_title' => array(
                'label' => '商品短标题',
                'label_width' => 150,
                'type' => 'text',
                'tab'=>'base',
                'tip_back' => '用于小票打印，可选',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'subtitle' => array(
                'label' => '副标题',
                'label_width' => 150,
                'type' => 'textarea',
                'tab' => 'base',
                'tip_back'=>'用于产品说明，请控制在100字以内',
                'data_val' => array(
                    'maxlength' => 100
                ),
                'data_val_msg' => array(
                    'maxlength' => '不超过{0}字'
                ),
            ),
            'allow' => array(
                'label' => '上架信息',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tab' => 'attr',
                'options' => array(
                    '0'=> array(
                        '0' => '0',
                        '1' => '下架'
                    ),
                    '1'=> array(
                        '0' => '1',
                        '1' => '上架'
                    ),
                ),
                'default' => '0'
            ),
            'img' => array( //TODO 尺寸
                'label' => '商品图',
                'label_width' => 150,
                'type' => 'upimg',
                'tab'=>'base',
                'tip_back' => '<span class="red">*</span>必须上传，尺寸为640*640',
                'img_width' => 640,
                'img_height' => 640,
                'extensions' => 'jpg,jpeg,gif,png',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '必须上传图片'
                ),
            ),
            'unit' => array(
                'label' => '单位',
                'label_width' => 150,
                'type' => 'text',
                'tab' => 'base',
                'data_val' => array(
                    'maxlength' => 5
                ),
                'data_val_msg' => array(
                    'maxlength' => '不超过{0}个字'
                ),
            ),
            'attr' => array(
                'label' => '商品属性',
                'label_width' => 150,
                'type' => 'textarea',
                'tab' => 'base',
                'placeholder' => '属性名1|属性值1|属性值2|属性值3,属性名1|属性值1|属性值2',
                'tip_back' => '辣度|微辣|中辣|特辣,切法|长条|方块(格式：属性名|属性标签|属性标签.多个属性标签用竖线隔开,多个属性用逗号隔开,属性名和属性标签之间用竖线隔开)',
                'close' => true
            ),
            'detail' => array(
                'label' => '商品详情',
                'label_width' => 150,
                'type' => 'ueditor',
                'tab' => 'detail',
            ),
            'product_price' => array(
                'label' => '价格',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'base',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00'
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00',
                '@minititle' => '商品原价：'
            ),
            'market_price' => array(
                'label' => '商品现价',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'base',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00'
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00',
                'merge' => true,
                'merge_type' => '1',
            ),
            'cost_price' => array(
                'label' => '商品成本',
                'label_width' => 150,
                'type' => 'number',
                'tab' => 'base',
                'follow_text' => '元',
                'data_val' => array(
                    'number' => true,
                    'min' => '0.00'
                ),
                'data_val_msg' => array(
                ),
                'default' => '0.00',
                'merge' => true,
                'merge_type' => '1',
            ),
            'total' => array(
                'label' => '库存数量',
                'label_width' => 150,
                'type' => 'amountdigits',
                'tab' =>'kucun',
                'data_val' => array(
                    'required' => true,
                    'digits' => true
                ),
                'data_val_msg' => array(
                    'required' => '必填字段'
                ),
                'default'=> 99
            ),
            'total_cnf' => array(
                'label' => '减库存方式',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tab' => 'kucun',
                'tip_back' =>'商品的剩余数量, 如启用多规格则此处设置无效。',
                'options' => array(
                    '0' => array(
                        '0' => '0',
                        '1' => '拍下减库存',
                    ),
                    '1' => array(
                        '0' => '1',
                        '1' => '付款减库存',
                    ),
                    '2' => array(
                        '0' => '2',
                        '1' => '永不减库存',
                    ),
                ),
                'default' => 2
            ),
            'sales' => array(
                'label' => '已出售数',
                'label_width' => 150,
                'type' => 'amountdigits',
                'tab' => 'base',
                'default' => 0
            ),
            'sales_real' => array(
                'label' => '实际售出数',
                'label_width' => 150,
                'type' => 'amountdigits',
                'tab' => 'base',
                'offedit' => true,
                'default' => 0
            ),
            'add_time' => array(
                'label' => '添加时间',
                'label_width' => 150,
                'type' => 'datetime',
                'close' => true
            ),
            'weight' => array(
                'label' => '重量',
                'label_width' => 150,
                'type' => 'text'
            ),
            'max_buy' => array(
                'label' => '单次最多购买',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'digits' => true
                ),
                'data_val_msg' => array(
                ),
            ),
            'user_max_buy' => array(
                'label' => '用户最多购买',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'digits' => true
                ),
                'data_val_msg' => array(
                ),
            ),
            'is_option' => array(
                'label' => '是否启用规格',
                'label_width' => 150,
                'type' => 'radiogroup',
                'tip_back' => '启用多规格后添加完商品编辑规格',
                'tab' => 'attr',
                'options' => array(
                    '0' => array(
                        '0' => '0',
                        '1' => '否'
                    ),
                    '1' => array(
                        '0' => '1',
                        '1' => '是'
                    )
                ),
                'default' => '0'
            ),
            'viewed' => array(
                'label' => '浏览量',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                    'required' => true,
                    'digits' => true
                ),
                'data_val_msg' => array(
                ),
            ),
            'deleted' => array(
                'label' => '是否放入回收站',
                'label_width' => 150,
                'tab'=> 'attr',
                'type' => 'bool',
                'default' => '0',
                'row_hide' => true
            ),
            'update_time' => array(
                'label' => '产品信息修改时间',
                'label_width' => 150,
                'type' => 'datetime',
                'close' => true
            ),
            'invoice' => array(
                'label' => '提供发票',
                'label_width' => 150,
                'type' => 'bool'
            ),
            'min_price' => array(
                'label' => '多规格中最小价格，无规格时显示销售价',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'max_price' => array(
                'label' => '多规格中最大价格，无规格时显示销售价',
                'label_width' => 150,
                'type' => 'text',
                'data_val' => array(
                ),
                'data_val_msg' => array(
                ),
            ),
            'show_total' => array(
                'label' => '显示库存',
                'label_width' => 150,
                'type' => 'bool',
                'tab' => 'kucun',
                'default' => 0
            ),
//            'is_status_time' => array(
//                'label' => '是否选择上架时间',
//                'label_width' => 150,
//                'type' => 'radiogroup',
//                'tab' => 'attr',
//                'tip_back' => '商品在选择时间内自动上架，过期自动下架',
//                'options' => array(
//                    '0'=> array(
//                        '0' => '0',
//                        '1' => '否'
//                    ),
//                    '1'=> array(
//                        '0' => '1',
//                        '1' => '是'
//                    )
//                ),
//                'default' => 0
//
//            ),
//            'status_time_start' => array(
//                'label' => '上架时间',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'attr',
//                'data_val' => array(
//                ),
//                'data_val_msg' => array(
//                ),
//                '@minititle' => '从：',
//            ),
//            'status_time_end' => array(
//                'label' => '到',
//                'label_width' => 150,
//                'type' => 'datetime',
//                'tab' => 'attr',
//                'merge' => true,
//                'merge_type' => '1',
//                '@minititle' => '到',
//            ),
            'can_notrefund' => array(
                'label' => '是否支持退换货',
                'label_width' => 150,
                'tab' => 'attr',
                'type' => 'radiogroup',
                'options' => array(
                    '0'=> array(
                        '0' => '0',
                        '1' => '是'
                    ),
                    '1'=> array(
                        '0' => '1',
                        '1' => '否'
                    )
                ),
                'default' => 0
            ),
            'show_sales' => array(
                'label' => '是否显示销量',
                'label_width' => 150,
                'type' => 'bool',
                'tab' => 'attr',
                'default' => 1,
            ),
            'merchant_id' => array(
                'label' => '选择商铺与所属分类',
                'label_width' => 150,
                'type' => 'select',
                'options' => DB::getopts('@pf_merchant','id,name',0),
                'valtype' => 'int',
                'tab' => 'base',
                'header' => array(
                    0 => '',
                    1 => '选择店铺',
                ),
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请选择店铺'
                ),
                '@minititle' => '所属店铺：'
            ),
            'cate_id' => array(
                'label' => '分类如下',
                'label_width' => 500,
                'tab' => 'base',
                'type' => 'select',
                'data_val' => array(
                    'required' => true
                ),
                'data_val_msg' => array(
                    'required' => '请选择商品分类'
                ),
                'merge' => true,
                'merge_type' => '1',
                'header' => array(
                    0 => '',
                    1 => '选择分类',
                ),
            ),
            'is_new' => array(
                'label' => '商品属性',
                'label_width' => 150,
                'type' => 'bool',
                'tab' => 'attr',
                '@minititle' => '新品：'
            ),
            'is_recommand' => array(
                'label' => '推荐',
                'label_width' => 150,
                'tab' => 'attr',
                'type' => 'bool',
                'merge' => true,
                'merge_type' => '1',
            ),
            'is_hot' => array(
                'label' => '热卖',
                'label_width' => 150,
                'type' => 'bool',
                'tab' => 'attr',
                'merge' => true,
                'merge_type' => '1',
            ),
            'is_discount' => array(
                'label' => '促销',
                'label_width' => 150,
                'type' => 'bool',
                'tab' => 'attr',
                'merge' => true,
                'merge_type' => '1',
            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 150,
                'type' => 'digits',
                'tab' => 'base',
                'default' => $this->getNextSort(),
                'data_val' => array (
                    'required' => true,
                    'digits' => true
                )
            ),
//            'index_tag' => array(
//                'label' => '首页分类推荐',
//                'label_width' => 150,
//                'tip_back' => '勾选后可以从首页入口进入',
//                'type' => 'checkgroup',
//                'options' => DB::getopts('@pf_tag_index','id,title',0,'type=0 AND allow=1'),
//                'tab' => 'base',
//            )
        );
    }
}