<?php 
namespace Ninja;
class DatabaseTable
{
	private $pdo;
	private $table;
	private $primaryKey;
	public function __construct(\PDO $pdo,string $table,string $primaryKey)
	{
		$this->pdo=$pdo;
		$this->table=$table;
		$this->primaryKey=$primaryKey;
	}
	function total()
	{
		$query=$this->query('SELECT count(*) FROM '.$this->table);

		$row=$query->fetch();
		return $row[0];
	}
	function query($sql,$para=[])
	{
			$query=$this->pdo->prepare($sql);
			$query->execute($para);
			return $query;
	}
	function insert($fields)
	{

		$sql='INSERT INTO '. $this->table .'(';

		foreach($fields as $key=>$value)
			$sql.=$key.',';
		$sql=rtrim($sql,',');

		$sql.=') VALUES (';

		foreach($fields as $key=>$value)
			$sql.=':'.$key.',';

		$sql=rtrim($sql,',');

		$sql.=')';
		$fields=$this->processDates($fields);
		$this->query($sql,$fields);
		
	}
	function delete($id)
	{
		$sql='DELETE FROM '. $this->table .' WHERE '.$this->primaryKey.'=:id';
		$para=[':id'=>$id];
		$this->query($sql,$para);
	}
	function update($fields)
	{
		$sql='UPDATE ' . $this->table .' SET ';
		foreach($fields as $key=>$value)
		{
			$sql.=$key .'=:'.$key.',';
		}
		$sql=rtrim($sql,',');
		$sql.=' WHERE '. $this->primaryKey.' =:primaryKey';
		$fields['primaryKey']=$fields['id'];
		$fields=$this->processDates($fields);
		$this->query($sql,$fields);
	}
	function processDates($fields)
	{
		foreach($fields as $key=>$value)
			if($value instanceof \DateTime)
				$fields[$key]=$value->format('Y-m-d H:i:s');
		return $fields;
	}
	

	function findById($value)
	{
		$sql='SELECT * FROM '. $this->table . ' WHERE ' .$this->primaryKey.' = :value';
		$para=['value'=>$value];
		$query=$this->query($sql,$para);
		return $query->fetch(); 
	}
	function find($column,$value)
	{
		$sql='SELECT * FROM ' . $this->table . ' WHERE ' .$column.' = :value';
		$para=['value'=>$value];
		$query=$this->query($sql,$para);
		return $query->fetchAll();
	}
	function findAll()
	{
		$sql='SELECT * FROM ' .$this->table ;
		return $this->query($sql);

	}
	function save($record)
	{

		try
		{
			if($record[$this->primaryKey]=='')
			{
				$record[$this->primaryKey]=null;
			}

			$this->insert($record);
		}
		catch(\PDOException $e)
		{
			$this->update($record);
		}
	}
}
?>
