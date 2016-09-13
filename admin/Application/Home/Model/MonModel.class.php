<?php
namespace Home\Model;
use Think\Model\MongoModel;  //
Class MonModel extends MongoModel
{
    public function __construct($name, $tablePrefix, $connection)
    {
        parent::__construct($name, $tablePrefix, $connection);
        $this->trueTableName=$name;//要连接的那个集合（表）控制器里传过来
    }
    protected $dbName='csh';//（要连接的数据库名称）
    protected $connection = array(
        'db_type' => 'mongo',
        'db_user' => '',//用户名(没有留空)
        'db_pwd' => '',//密码（没有留空）
        'db_host' => '127.0.0.1',//数据库地址
        'db_port' => '27017',//数据库端口 默认27017
    );
    protected $_idType = self::TYPE_INT; //参考手册
    protected $_autoinc = true;//参考手册

}
