<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../../modelos/concursos.php'; 
class DAOConcurso
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
	public function obtenerTodos()
	{
		try
		{
            $this->conectar();
            
			$lista = array();
            /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,fechaInicio,fechaLimite,estatus FROM concursos");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute();
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
			foreach($resultado as $fila)
			{
				$obj = new Concurso();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->fechaInicio = $fila->fechaInicio;
                $obj->fechaLimite = $fila->fechaLimite;
                $obj->estatus = $fila->estatus;
	            
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

    public function obtenerTodosCuenta()
{
    try
    {
        $this->conectar();

        $lista = array();
        $sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,fechaInicio,fechaLimite,estatus FROM concursos where estatus='Activo'");

        $sentenciaSQL->execute();

        $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);

        foreach($resultado as $fila)
        {
            $obj = new Concurso();
            $obj->id = $fila->id;
            $obj->nombre = $fila->nombre;
            $obj->fechaInicio = $fila->fechaInicio;
            $obj->fechaLimite = $fila->fechaLimite;
            $obj->estatus = $fila->estatus;

            $lista[] = $obj;
        }

        // Verifica si al menos un registro fue obtenido
        $alMenosUnRegistro = !empty($lista);

        return $alMenosUnRegistro;
    }
    catch(PDOException $e){
        return false;
    } finally {
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
            
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,fechaInicio,fechaLimite,estatus FROM concursos WHERE id=?"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Concurso();
            $obj->id = $fila->id;
            $obj->nombre = $fila->nombre;
            $obj->fechaInicio = DateTime::createFromFormat('Y-m-d',$fila->fechaInicio);
            $obj->fechaLimite = DateTime::createFromFormat('Y-m-d',$fila->fechaLimite);
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
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM concursos WHERE id = ?");			          
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
	public function editar(Concurso $obj)
	{
		try 
		{
			$sql = "UPDATE concursos
                    SET
                    nombre = ?,
                    fechaInicio = ?,
                    fechaLimite = ?
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->fechaInicio->format('Y-m-d'),
                      $obj->fechaLimite->format('Y-m-d'),
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

    public function activar($id)
	{
		try 
		{
			$sql = "UPDATE concursos
                    SET
                    estatus='Activo'
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

    public function desactivar($id)
	{
		try 
		{
			$sql = "UPDATE concursos
                    SET
                    estatus='Inactivo'
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

    public function desactivarDemas($id)
	{
		try 
		{
			$sql = "UPDATE concursos
                    SET
                    estatus='Inactivo'
                    WHERE id != ?;";

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

	
	/**
     * Agrega un nuevo usuario de acuerdo al objeto recibido como parámetro
     */
    public function agregar(Concurso $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO concursos
                (nombre,
                fechaInicio,
                fechaLimite,
                estatus)
                VALUES
                (:nombre,
                :fechaInicio,
                :fechaLimite,
                :estatus);";
                
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(array(
                    ':nombre'=>$obj->nombre,
                 ':fechaInicio'=>$obj->fechaInicio->format('Y-m-d'),
                 ':fechaLimite'=>$obj->fechaLimite->format('Y-m-d'),
                ':estatus'=>$obj->estatus));
                 
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