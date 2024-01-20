<?php
require_once(URL_MODEL .'entidad.inc.php');

class Disco extends Entidad
{

    private $artista;

    private $duracion;

    private $iswc;
    // Constructor de la clase Disco
    public function __construct(int $id = 0, string $titulo = '', DateTime $anio = null, string $publicacion = '', string $genero = '' , string $imagen = '', bool $estado = true, 
                                string $artista = '', int $duracion = 0, string $iswc = '')
    {
        // Llamada al constructor de la clase padre
        parent::__construct($id, $titulo, $anio, $publicacion, $genero, $imagen . $estado);
        $this->artista = $artista;
        $this->duracion = $duracion;
        $this->iswc = $iswc;
    }
    /**
     * Getters
     */
    public function getArtista(): string
    {
        return $this->artista;
    }

    public function getDuracion(): int|null
    {
        return $this->duracion;
    }

    public function getIswc() : string
    {
        return $this->iswc;
    }
    /**
     * Setters
     */

    public function setArtista(string $artista): void
    {
        $this->artista = $artista;
    }

    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
    }

    public function setIswc(string $iswc): void
    {
        $this->iswc = $iswc;
    }


    public function __toString()
    {
        return parent::__toString() . " Artista: " . $this->artista . " Duracion: " . $this->duracion . " ISWC: " . $this->iswc;
    }

}

?>