<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../../modelos/equipo.php'; 
class DAOEquipo
{
    //EN TODOS LOS DAOS
	private $conexion; 
    
    /**
     * Permite obtener la conexión a la BD
     */
    private function conectar(){
        try{
			$this->conexion = Conexion::conectar(); 
		}
		catch(Exception $e)
		{
			die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
		}
    }
    //EN TODOS LOS DAOS
    
   /**
    * Metodo que obtiene todos los usuarios de la base de datos y los
    * retorna como una lista de objetos  
    */
	public function obtenerTodos($id)
	{
		try
		{
            $this->conectar();
            
			$lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,integrante1,integrante2,integrante3 FROM equipos WHERE id_couch=?");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute([$id]);
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
			foreach($resultado as $fila)
			{
				$obj = new Equipo();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->integrante1 = $fila->integrante1;
                $obj->integrante2 = $fila->integrante2;
	            $obj->integrante3 = $fila->integrante3;

				//Agrega el objeto al arreglo, no necesitamos indicar un índice, usa el próximo válido
                $lista[] = $obj;
			}
            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}

    public function obtenerTodosAdmin()
	{
		try
		{
            $this->conectar();
            
			$lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL = $this->conexion->prepare("SELECT e.id,e.nombre,e.integrante1,e.integrante2,e.integrante3,
                        e.estatus,e.institucion,e.id_couch, c.nombrecompleto as coach FROM equipos e INNER JOIN couch c ON e.id_couch = c.id");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute();
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
			foreach($resultado as $fila)
			{
				$obj = new Equipo();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->integrante1 = $fila->integrante1;
                $obj->integrante2 = $fila->integrante2;
	            $obj->integrante3 = $fila->integrante3;
                $obj->coach = $fila->coach;
                $obj->id_couch = $fila->id_couch;
                $obj->estatus = $fila->estatus;
	            $obj->institucion = $fila->institucion;

				//Agrega el objeto al arreglo, no necesitamos indicar un índice, usa el próximo válido
                $lista[] = $obj;
			}
            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    
	/**
     * Metodo que obtiene un registro de la base de datos, retorna un objeto  
     */
    public function obtenerUno($id)
	{
		try
		{ 
            $this->conectar();
            
            //Almacenará el registro obtenido de la BD
			$obj = null; 
            
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,integrante1,integrante2,integrante3,estatus,id_couch,institucion FROM equipos WHERE id=?"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Equipo();
            
            $obj->id = $fila->id;
            $obj->nombre = $fila->nombre;
            $obj->integrante1 = $fila->integrante1;
            $obj->integrante2 = $fila->integrante2;
            $obj->integrante3 = $fila->integrante3;
            $obj->id_couch = $fila->id_couch;
            $obj->institucion = $fila->institucion;
            $obj->estatus = $fila->estatus;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    /**
     * Elimina el usuario con el id indicado como parámetro
     */
	public function eliminar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM equipos WHERE id = ?");			          
			$resultado=$sentenciaSQL->execute(array($id));
			return $resultado;
		} catch (PDOException $e) 
		{
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;	
		}finally{
            Conexion::desconectar();
        }

		
        
	}

	/**
     * Función para editar al empleado de acuerdo al objeto recibido como parámetro
     */
	public function editar(Equipo $obj)
	{
		try 
		{
			$sql = "UPDATE equipos
                    SET
                    nombre = ?,
                    integrante1 = ?,
                    integrante2 = ?,
                    integrante3 = ?
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->integrante1,
                      $obj->integrante2,
					  $obj->integrante3,
					  $obj->id)
					);
            return true;
		} catch (PDOException $e){
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function aprobar($id)
	{
		try 
		{
			$sql = "UPDATE equipos
                    SET
                    estatus='Aprobado'
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($id));
            return true;
		} catch (PDOException $e){
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

    public function aprobarTodos()
	{
		try 
		{
			$sql = "UPDATE equipos
                    SET
                    estatus='Aprobado'
                    WHERE id > 0;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute();
            return true;
		} catch (PDOException $e){
			//Si quieres acceder expecíficamente al numero de error
			//se puede consultar la propiedad errorInfo
			return false;
		}finally{
            Conexion::desconectar();
        }
	}

	
	/**
     * Agrega un nuevo usuario de acuerdo al objeto recibido como parámetro
     */
    public function agregar(Equipo $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO equipos
                (nombre,
                integrante1,
                integrante2,
                integrante3,
                estatus,
                id_couch,
                institucion)
                VALUES
                (:nombre,
                :integrante1,
                :integrante2,
                :integrante3,
                :estatus,
                :id_couch,
                :institucion);";
                
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $obj->nombre);
            $stmt->bindParam(':integrante1', $obj->integrante1);
            $stmt->bindParam(':integrante2', $obj->integrante2);
            $stmt->bindParam(':integrante3', $obj->integrante3);
            $stmt->bindParam(':estatus', $obj->estatus);
            $stmt->bindParam(':id_couch', $obj->id_couch);
            $stmt->bindParam(':institucion', $obj->institucion);
            $stmt->execute();
                 
            //SABER EL ULTIMO ID INSERTADO CON AUTOINCREMENT
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
			return $clave;
		}finally{
            
            /*En caso de que se necesite manejar transacciones, 
			no deberá desconectarse mientras la transacción deba 
			persistir*/
            
            Conexion::desconectar();
        }
	}
}