<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once __DIR__ . '/../modelos/auxiliar.php';


class DAOAuxiliar
{
    
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
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,apellido1,apellido2,email,tipo FROM UsuariosAuxiliar");
			
            //Se ejecuta la sentencia sql, retorna un cursor con todos los elementos
			$sentenciaSQL->execute();
            
            //$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
            /*Podemos obtener un cursor (resultado con todos los renglones como 
            un arreglo de arreglos asociativos o un arreglo de objetos*/
            /*Se recorre el cursor para obtener los datos*/
			foreach($resultado as $fila)
			{
				$obj = new Auxiliar();
                $obj->id = $fila->id;
	            $obj->nombre = $fila->nombre;
	            $obj->apellido1 = $fila->apellido1;
                $obj->apellido2 = $fila->apellido2;
	            $obj->email = $fila->email;
	            $obj->tipo = $fila->tipo;
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
            
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,apellido1,apellido2,email,tipo,password FROM UsuariosAuxiliar WHERE id=?"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute([$id]);
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new Auxiliar();
            
            $obj->id = $fila->id;
            $obj->nombre = $fila->nombre;
            $obj->apellido1 = $fila->apellido1;
            $obj->apellido2 = $fila->apellido2;
            $obj->email = $fila->email;
            $obj->tipo = $fila->tipo;
        
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

    public function autenticar($correo, $password)
	{
		try
		{ 
            $this->conectar();
            
            //Almacenará el registro obtenido de la BD
			$obj = null; 
            
			$sentenciaSQL = $this->conexion->prepare("SELECT id,nombre,apellido1,apellido2,tipo FROM usuariosAuxiliar WHERE email=? AND password=sha2(?,224)"); 
			//Se ejecuta la sentencia sql con los parametros dentro del arreglo 
            $sentenciaSQL->execute(array($correo,$password));
            
            /*Obtiene los datos*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			if($fila){
                $obj = new Auxiliar();
                
                $obj->id = $fila->id;
                $obj->nombre = $fila->nombre;
                $obj->apellido1 = $fila->apellido1;
                $obj->apellido2 = $fila->apellido2;
                $obj->tipo = $fila->tipo;
            
                return $obj;
            }
            return null;
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
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM usuariosAuxiliar WHERE id = ?");			          
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
	public function editar(Auxiliar $obj)
	{
		try 
		{
			$sql = "UPDATE usuariosAuxiliar
                    SET
                    nombre = ?,
                    apellido1 = ?,
                    apellido2 = ?,
                    email = ?,                   
                    tipo = ? ,                   
                    password = sha2(?,224)
                    WHERE id = ?;";

            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->apellido1,
                      $obj->apellido2,
					  $obj->email,                
                      $obj->tipo,                      
                      $obj->password,
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

	

	
	/**
     * Agrega un nuevo usuario de acuerdo al objeto recibido como parámetro
     */
    public function agregar(Auxiliar $obj)
	{
        $clave=0;
		try 
		{
            $sql = "INSERT INTO 
            usuariosAuxiliar
                (nombre,
                apellido1,
                apellido2,
                email,
                tipo,                
                password)
                VALUES
                (:nombre,                
                :apellido1,
                :apellido2,
                :email,                
                :tipo,
                sha2(:password,224));";
                
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $obj->nombre);            
            $stmt->bindParam(':apellido1', $obj->apellido1);
            $stmt->bindParam(':apellido2', $obj->apellido2);
            $stmt->bindParam(':email', $obj->email);
            $stmt->bindParam(':tipo', $obj->tipo);
            $stmt->bindParam(':password', $obj->password);            
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