<?php namespace dao;

use dao\Connection as Connection;
use dao\Singleton as Singleton;
use model\User as User;
use interfaces\ICrud as ICrud;

class UserDAO extends Singleton implements ICrud{
	protected $table = "users"; /* se agregar para el dia de mañana modificar una vez el nombre de la tabla */
	private $connection;

	//object factoryDao

	public function __construct(){}

	public function create($user){
		$sql = "INSERT INTO $this->table (
			id_user,role_user,username,pass,email,name_user,surname,dni,profile_picture
		) VALUES (
			:id_user,:role_user,:username,:pass,:email,:name_user,:surname,:dni,:profile_picture
		)";

		$params['id_user'] = $user->getIdUser();
		$params['role_user'] = 'user';
		$params['username'] = $user->getUsername();
		$params['pass'] = $user->getPass();
		$params['email'] = $user->getEmail();
		$params['name_user'] = $user->getNameUser();
		$params['surname'] = $user->getSurname();
		$params['dni'] = $user->getDni();
		$params['profile_picture'] = $user->getProfilePicture();

		try {
			$this->connection = Connection::getInstance();
			return $this->connection->executeNonQuery( $sql , $params );
		} catch (\PDOException $th) {
			throw $th;
		}

	}

	public function read($username){
		$sql = "SELECT * FROM users WHERE username = :username";

		$params['username'] = $username;

		try {
			$this->connection = Connection::getInstance();
			$result = $this->connection->execute( $sql, $params);
		} catch ( Exception $th) {
			throw $th;
		}

		if( ! empty($result))
			return $this->mapMethod($result);
		else
			return false;
	}

	public function readAll(){}

	public function readByUsernameOrEmail ($userOrEmail) {
		
		
	}

	public function readByUser($data){
		
	}

	public function update($data,$idData){}

	public function delete($v){}

	public function mapMethodCollection($dataSet)
	{
		$collection = new Collection();
		foreach ($dataSet as $p) {
			$u = new User(
				$p['id_user'],
				$p['role_user'],
				$p["username"],
				$p["pass"],
				$p["email"],
				$p["name_user"],
				$p["surname"],
				$p["dni"],
				$p["profile_picture"]
			);
			$collection->add($u);
		}
		return $collection;
	}

	public function mapMethod ($dataSet) {
		$p = $dataSet;
		$u = new User(
			$p['id_user'],
			$p['role_user'],
			$p["username"],
			$p["pass"],
			$p["email"],
			$p["name_user"],
			$p["surname"],
			$p["dni"],
			$p["profile_picture"]
		);
		return $u;
	}

	protected function mapear($value) {

		$value = is_array($value) ? $value : [];

		$resp = array_map(function($p){
			return new M_Usuario($p['id'], $p['name'], $p['surname'], $p['birthdate'], $p['nationality'], $p['state'], $p['city'], $p['email'], $p['password'], $p['avatar'], $p['role']);
		}, $value);

		   return count($resp) > 1 ? $resp : $resp['0'];

	}

}//class end
