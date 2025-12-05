<?PHP
require_once "Modelo/SanitizarEntrada.php";
 class ObjProductos{ 
    
    private  $controlError=array();

	 Private $id;
    Private $Codigo;
    Private $Producto;
    Private $Precio;
    Private $Cantidad;

    Private $pdo;
    public $idp;
    Private $Accion;

	

	Public function __construct($pdo){ 
	
		$this->pdo = $pdo;
		
	} //introduceDatos

	public function DatosRequeridos(array $datos){


		 $this->Codigo = SanitizarEntrada::limpiarXSS($datos["codigo"]);
		 $datos["producto"]= SanitizarEntrada::limpiarXSS($datos["producto"]);
    	 $this->Producto = SanitizarEntrada::TipoTitulo($datos["producto"]);
    	 $this->Precio = $datos["precio"];
    	 $this->Cantidad = $datos["cantidad"];

	}

	public function getCodigo(){
		return $this->Codigo;
	}
    public function getCantidad(){
		return $this->Cantidad;
	}
    public function getPrecio(){
		return $this->Precio;
	}
     public function getProducto(){
		return $this->Producto;
	}
	

	
	public function registrarProductos(){ 
    		
			$data = array(
			"codigo" => "$this->Codigo",
			"producto" => "$this->Producto",
			"precio" => $this->Precio,
         "cantidad" =>$this->Cantidad);
			
			$resultado = $this->pdo->insertSeguro("productos",$data);

			return $resultado;
	}

	public function AllProducts(){ 
    
		  return $this->pdo->Arreglos("SELECT * FROM productos");
			
	}//Listar Productors

	public function actualizarProducto(){

    // Validar que el ID exista antes de actualizar
    if (!$this->pdo->existeID("productos", $this->idp)) {
        return "ERROR_ID_NO_EXISTE";   // <-- Mensaje claro para tu controlador
    }

    $dataActualizar = array(
        "codigo" => "$this->Codigo",
        "producto" => "$this->Producto",
        "precio" => $this->Precio,
        "cantidad" => $this->Cantidad
    );

    $condicion = array(
        "id" => $this->idp
    );

    if ($this->pdo->updateSeguro("productos", $dataActualizar, $condicion)) {
        return true;
    }

    return false;
}
//fin de actualizarProductos

} //fin ValidacionLogin




?>		