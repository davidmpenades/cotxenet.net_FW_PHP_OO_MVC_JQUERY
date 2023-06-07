<?php
class shop_dao
{
	static $_instance;

	private function __construct()
	{
	}
	public static function getInstance()
	{
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function select_list_car($db, $orderby, $total_prod, $items_page)
	{
		$sql = "SELECT c.id_car,m.cod_marca marca,c.km,c.puertas,c.color,c.city ciudad,c.f_mat,m.descripcion modelo, c.num_matricula, c.precio,c.observaciones,f.img_car,
		        ca.descripcion carroceria,cat.nombre_cat,ci.descripcion cilindrada,e.descripcion etiqueta,c.lon,c.lat
                FROM car c, modelo m,fotos f,carroceria ca,categoria cat,cilindrada ci,combustible co,etiqueta e
                WHERE c.cod_modelo=m.cod_modelo AND c.num_bastidor=f.num_bastidor AND f.img_car like '%\pr-%' 
				AND c.carroceria=ca.cod_carroceria AND c.categoria=cat.cod_categoria AND c.cod_combustible=co.cod_combustible
				AND c.cod_cil=ci.cod_cilindrada AND c.cod_etiqueta=e.cod_etiqueta ORDER BY c.visitas DESC
				LIMIT $total_prod,$items_page;";

		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_count($db)
	{

		$sql = "SELECT COUNT(*) n_prod
                FROM car c, modelo m,fotos f,carroceria ca,categoria cat,cilindrada ci,combustible co,etiqueta e
                WHERE c.cod_modelo=m.cod_modelo AND c.num_bastidor=f.num_bastidor AND f.img_car like '%\pr-%' 
				AND c.carroceria=ca.cod_carroceria AND c.categoria=cat.cod_categoria AND c.cod_combustible=co.cod_combustible
				AND c.cod_cil=ci.cod_cilindrada AND c.cod_etiqueta=e.cod_etiqueta ORDER BY c.visitas DESC;";

		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_all_cars($db, $total_prod, $items)
	{
		$sql = "SELECT c.id_car,m.cod_marca marca,c.km,c.puertas,c.color,c.city ciudad,c.f_mat,m.descripcion modelo, c.num_matricula, c.precio,c.observaciones,f.img_car,
		        ca.descripcion carroceria,cat.nombre_cat,ci.descripcion cilindrada,e.descripcion etiqueta,c.lon,c.lat
                FROM car c, modelo m,fotos f,carroceria ca,categoria cat,cilindrada ci,combustible co,etiqueta e
                WHERE c.cod_modelo=m.cod_modelo AND c.num_bastidor=f.num_bastidor AND f.img_car like '%\pr-%' 
				AND c.carroceria=ca.cod_carroceria AND c.categoria=cat.cod_categoria AND c.cod_combustible=co.cod_combustible
				AND c.cod_cil=ci.cod_cilindrada AND c.cod_etiqueta=e.cod_etiqueta ORDER BY c.visitas DESC
				LIMIT $total_prod,$items;";

		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_count_filter($db, $filter)
	{
		$sql = "SELECT COUNT(c.id_car) n_prod
					FROM (SELECT c.id_car,c.km,c.num_matricula,c.cod_combustible,c.categoria,c.observaciones,c.puertas,
					c.precio,c.cod_etiqueta,c.f_mat,c.color,c.city,c.cod_modelo,m.descripcion modelo, f.img_car,  
					co.descripcion combustible, m.cod_marca marca,carr.descripcion carroceria,c.lon,c.lat,c.visitas
					FROM car c INNER JOIN fotos f INNER JOIN categoria ca INNER JOIN combustible co INNER JOIN modelo m INNER JOIN carroceria carr
					ON c.num_bastidor = f.num_bastidor AND f.img_car LIKE '%\pr-%' AND c.categoria = ca.cod_categoria AND c.cod_combustible = co.cod_combustible 
					AND c.cod_modelo =m.cod_modelo AND c.carroceria= carr.cod_carroceria) AS c";

		for ($i = 0; $i < count($filter); $i++) {
			if ($i == 0) {
				if ($filter[$i][0] == 'order') {
					$sql .= " ORDER BY " . $filter[$i][1] . " ASC";
				} else {
					$sql .= " WHERE c." . $filter[$i][0] . '= "' . $filter[$i][1] . '"';
				}
			} else {
				if ($filter[$i][0] == 'order') {
					$sql .= " ORDER BY " . $filter[$i][1] . " ASC";
				} else {
					$sql .= " AND c." . $filter[$i][0] . '= "' . $filter[$i][1] . '"';
				}
			}

			$stmt = $db->ejecutar($sql);
			return $db->listar($stmt);
		}
	}
	public function select_filter($db, $filter, $total_prod, $items)
	{
		$sql = "SELECT c.*					
				FROM (SELECT c.id_car,c.km,c.num_matricula,c.cod_combustible,c.categoria,c.observaciones,c.puertas,c.precio,c.cod_etiqueta,c.f_mat,c.color,c.city,c.cod_modelo,m.descripcion modelo, f.img_car,  
				co.descripcion combustible, m.cod_marca marca,carr.descripcion carroceria,c.lon,c.lat,c.visitas
				FROM car c INNER JOIN fotos f INNER JOIN categoria ca INNER JOIN combustible co INNER JOIN modelo m INNER JOIN carroceria carr
				ON c.num_bastidor = f.num_bastidor AND f.img_car LIKE '%\pr-%' AND c.categoria = ca.cod_categoria AND c.cod_combustible = co.cod_combustible 
				AND c.cod_modelo =m.cod_modelo AND c.carroceria= carr.cod_carroceria) AS c";

		for ($i = 0; $i < count($filter); $i++) {
			if ($i == 0) {
				if ($filter[$i][0] == 'order') {
					$sql .= " ORDER BY " . $filter[$i][1] . " ASC";
				} else {
					$sql .= " WHERE c." . $filter[$i][0] . '= "' . $filter[$i][1] . '"';
				}
			} else {
				if ($filter[$i][0] == 'order') {
					$sql .= " ORDER BY " . $filter[$i][1] . " ASC";
				} else {
					$sql .= " AND c." . $filter[$i][0] . '= "' . $filter[$i][1] . '"';
				}
			}
		}
		$sql .= " LIMIT " . $total_prod . "," . $items;
		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_car($db, $id_car)
	{
		$sql = "SELECT c.id_car,
					m.cod_marca marca,
					c.km,c.puertas,c.color,
					c.city ciudad,
					c.f_mat,
					m.descripcion modelo, 
					c.num_matricula, 
					c.precio,
					c.observaciones,
					f.img_car,
					ca.descripcion carroceria,
					cat.nombre_cat ,
					ci.descripcion cilindrada,
					e.descripcion etiqueta,
					c.lon,
					c.lat
                FROM car c, 
					modelo m,
					fotos f,
					carroceria ca,
					categoria cat,
					cilindrada ci,
					combustible co,
					etiqueta e
                WHERE c.id_car=$id_car 
				AND c.cod_modelo=m.cod_modelo 
				AND c.num_bastidor=f.num_bastidor 
				AND c.carroceria=ca.cod_carroceria 
				AND c.categoria=cat.cod_categoria 
				AND c.cod_combustible=co.cod_combustible
				AND c.cod_cil=ci.cod_cilindrada 
				AND c.cod_etiqueta=e.cod_etiqueta;";
				
		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_count_related($db, $marca)
	{
		$sql = "SELECT COUNT(*) AS n_prod
				FROM car c, modelo m
				WHERE c.cod_modelo = m.cod_modelo AND m.cod_marca = '$marca';";

		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_car_related($db, $marca, $items)
	{
		$sql = "SELECT *,m.descripcion, ca.nombre_cat
		FROM car c, modelo m, categoria ca
		WHERE c.cod_modelo = m.cod_modelo AND c.categoria = ca.cod_categoria 
		AND m.cod_marca = '$marca'
		LIMIT $items,3;";
		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
	public function select_likes($db,$id_car,$username){
		$sql = "SELECT l.id_car FROM likes l
				WHERE l.id_user = (SELECT u.id_user FROM users u WHERE u.username = '$username')
				AND l.id_car = '$id_car'";
		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt); 
	}
	public function delete_likes($db,$id_car,$username){
        $sql = "DELETE FROM likes WHERE id_car='$id_car' AND id_user=(SELECT  u.id_user FROM users u WHERE u.username = '$username')";
		
		$stmt = $db->ejecutar($sql);
	}
	public function insert_likes($db,$id_car,$username){
        $sql = "INSERT INTO likes (id_user, id_car) VALUES ((SELECT  u.id_user FROM users u WHERE u.username = '$username') ,'$id_car');";
		
		$stmt = $db->ejecutar($sql);
	}
	public function select_load_likes($db,$username){
        $sql = "SELECT l.id_car FROM likes l WHERE l.id_user = (SELECT u.id_user FROM users u WHERE u.username = '$username')";
		$stmt = $db->ejecutar($sql);
		return $db->listar($stmt);
	}
}
