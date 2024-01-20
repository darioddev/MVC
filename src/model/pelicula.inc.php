<?php
require_once(URL_MODEL .'entidad.inc.php');
?>

<?php
class Pelicula extends Entidad
{
    private $director;

    private $reparto;

    private $duracion;

    private $isan;

    public function __construct(int $id = 0, string $titulo = '', DateTime $anio = null, string $publicacion = '', string $genero = '', string $imagen = '', 
                                bool $estado = true, string $director = '', string $reparto = '', int $duracion = 0, string $isan = '')
    {
        parent::__construct($id, $titulo, $anio, $publicacion, $genero, $imagen . $estado);
        $this->reparto = $reparto;
        $this->director = $director;
        $this->duracion = $duracion;
        $this->isan = $isan;
    }

    /**
     * Getters
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    public function getReparto(): string|null
    {
        return $this->reparto;
    }

    public function getDuracion(): int|null
    {
        return $this->duracion;
    }

    public function getIsan(): string
    {
        return $this->isan;
    }

    /**
     * Setters
     */

    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    public function setReparto(string $reparto): void
    {
        $this->reparto = $reparto;
    }

    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
    }

    public function setIsan(string $isan): void
    {
        $this->isan = $isan;
    }

    public function __toString()
    {
        return parent::__toString() . " Director: " . $this->director . " Reparto: " . $this->reparto . " Duracion: " . $this->duracion . " ISAN: " . $this->isan;
    }

}

?>