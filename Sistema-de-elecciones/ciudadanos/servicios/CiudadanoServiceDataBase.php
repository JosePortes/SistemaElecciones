<?php
require_once '../../Datos/conexion.php';
class CiudadanoServiceDatabase
{

    //Atributos
    private $context;

    //Constructores
    public function __construct()
    {
        $this->context = new Conexion();
    }

    //Funciones
    //Obtiene todos los Ciudadano en la bd
    public function ListarCiudadano()
    {

        $ciudadanos = array();

        $db = $this->context->conectar();

        $stmt = $db->prepare("SELECT * FROM ciudadanos ORDER BY Estado ");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows !== 0) {

            while ($row = $result->fetch_object()) {

                $ciudadano = new Ciudadano();

                $ciudadano->StartData($row->Cedula, $row->Nombre, $row->Apellido, $row->Email, $row->Estado);

                array_push($ciudadanos, $ciudadano);

            }

        }

        $stmt->close();

        return $ciudadanos;
    }

    //Devuelve el ciudadano del $id proporcionado
    public function ObtenerId($id)
    {
        $db = $this->context->conectar();

        $ciudadano = new Ciudadano();

        $stmt = $db->prepare('SELECT * FROM ciudadanos WHERE Cedula = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

            while ($row = $result->fetch_object()) {

                $ciudadano->StartData($row->Cedula, $row->Nombre, $row->Apellido, $row->Email, $row->Estado);

            }

        }

        $stmt->close();

        return $ciudadano;

    }

    //Agrega un ciudadano a la lista de ciudadano
    public function Agregar($ciudadano)
    {

        $db = $this->context->conectar();

        $stmt = $db->prepare('INSERT INTO ciudadanos (Cedula, Nombre, Apellido, Email, Estado) VALUES (?,?,?,?,?)');

        $stmt->bind_param('sssss', $ciudadano->Cedula, $ciudadano->Nombre, $ciudadano->Apellido, $ciudadano->Email, $ciudadano->Estado);

        $stmt->execute();
        $stmt->close();

    }

    //Borrar el ciudadano de la lista de ciudadano, con el $id proporcionado
    public function Borrar($id)
    {
        $db = $this->context->conectar();

        $stmt = $db->prepare("UPDATE ciudadanos SET Estado = 'Inactivo' WHERE Cedula=?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
    }

    //Actualizar ciudadano
    public function Actualizar($id, $ciudadano)
    {

        $db = $this->context->conectar();

        $stmt = $db->prepare('UPDATE ciudadanos SET Nombre = ?, Apellido = ?, Email = ?, Estado = ? WHERE Cedula = ?');

        $stmt->bind_param('sssss', $ciudadano->Nombre, $ciudadano->Apellido, $ciudadano->Email, $ciudadano->Estado, $id);

        $stmt->execute();
        $stmt->close();

    }

}
