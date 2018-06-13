<?php
/**
* 数据库操作类
 * @author YuanFu<yuanf@pvc123.com>
 * @date 2018-06-06
 */
class Database{

	private static $host = 'localhost';
	private static $user = 'root';
	private static $password = 'sky817424';
	private static $database = 'oa_system';
	private static $port = 3306;

	public  $mysqli = null;
	public  $isLocal = false;//是否本地

	/**
	* 初始化数据库连接
	*/
	public function __construct(){	
		$this->mysqli = $this->connection();
		if( $this->mysqli ) $this->mysqli->query("set names 'utf8' ");
	}

	/**
	* 数据库连接
	*/
	public function connection(){
		return $this->isLocal? new MySQLi(self::$host, self::$user, self::$password,self::$database) : 
							   new MySQLi(self::$host, self::$user, self::$password, self::$database);

	}

	/**
	* 根据指定条件判断是否存在
	* @param string 表格名称
	* @param string|array 查询条件
	* @return boolean 查询结果,存在则返回true,不存在则返回false
	*/
	public function find($table, $where = '' ){
		
		$result = $this->mysqli->query("select 1 as isExists from {$table} ".$this->whereStr($where)." limit 1");
		$row = $result->fetch_assoc();
		
		return empty($row['isExists'])? false : true;

	}

	/**
	* 根据指定的列，记录数，条件返回数据查询结果
	* @param string 表名
	* @param array|string 查询列
	* @param int|string 查询行数,eg: "1", "1,20"
	* @param string|array 查询条件
	* @return array 查询后的结果
	*/
	public function findColumn($table, $columns, $where = '', $limit = 0){
		if(is_array($columns)){
			$columns = "`".implode("`,`",$columns)."`";
		}

		$limit_str = "";
		if (!empty($limit)){
			$limit_str = " limit {$limit}";
		}

		$resultArr = array();
		$result = $this->mysqli->query("select {$columns} from {$table}" . $this->whereStr($where)." {$limit_str}");

		while ($row = $result->fetch_assoc() ) {
			$resultArr[] = $row;
		}
		return $resultArr;
	}

	/**
	* 拼接查询条件,必须为数组才需要拼接
	* @param array 条件
	* @return string 拼接后的条件查询
	*/
	public function whereStr($where){

		if (empty($where)) return "";

		$where_str = "";
		//数组需要拼接
		if (is_array($where)){
			$where_str = " where 1=1 ";
			foreach ($where as $k => $v){
				$where_str .= " and $k='$v' ";
			}
		}else{
			$where_str = " where " . $where;
		}
		
		return $where_str;
	}

	/**
	* 将数据插入指定数据表
	* @param string 指定表名
	* @param array 插入数据，键值为相应数据表的列名
	* @return bool 操作结果
	*/
	public function insert($table, $datas){
		
		$sql = "insert into {$table} (`" . implode("`,`", array_keys($datas)) . "`) values ('" . implode("','", $datas) . "')";
		return $this->mysqli->query($sql);
	}

	/**
	* 将数据更新指定数据表
	* @param string 指定表名
	* @param array 更新数据，键值为相应数据表的列名
	* @param string 更新数据的条件限制
	* @return bool 操作结果
	*/
	public function update($table, $datas, $where){
		
		$sql = "update {$table} set ";
		foreach ($datas as $k => $v) {
			$sql .= "$k = '{$v}',";
		}
		return $this->mysqli->query(substr($sql, 0, -1). " where ". $where);
	}
	/**
	* 更新数据，根据指定条件查询数据是否存在,存在则更新，不存在则插入
	* @param string 操作数据表
	* @param array 操作数据数组
	* @param string 操作数据表的条件
	* @return bool 操作结果
	*/
	public function modify($table, $datas, $where){

		//查询是否存在
		$is_exists = $this->find($table, $where);
		//存在则更改，否则插入
		$result = true === $is_exists? $this->update($table, $datas, $where) : $this->insert($table,$datas);
		
		return $result;
	}
	/**
	* 直接执行sql语句
	* @param string sql;
	*/
	public function querySql($sql){
		return $this->mysqli->query($sql);
	}

}