<?php
require_once(URL_MODEL .'entidad.inc.php');
?>

<?php
class Libro extends Entidad
{
    private $autor;

    private $paginas;

    private $isbn;

    public function __construct(int $id = 0, string $titulo = '', DateTime $anio = null, string $publicacion = '', string $genero = '', string $imagen = '', 
                                bool $estado = true, string $autor = '', int $paginas = 0, string $isbn = '')
    {
        parent::__construct($id, $titulo, $anio, $publicacion, $genero, $imagen . $estado);
        $this->autor = $autor;
        $this->paginas = $paginas;
        $this->isbn = $isbn;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function getPaginas(): int
    {
        return $this->paginas;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setAutor(string $autor): void
    {
        $this->autor = $autor;
    }

    public function setPaginas(int $paginas): void
    {
        $this->paginas = $paginas;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function __toString()
    {
        return parent::__toString() . " Autor: " . $this->autor . " Paginas: " . $this->paginas . " ISBN: " . $this->isbn;
    }

}
?>