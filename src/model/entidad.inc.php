<?php

/**
 * Clase abstracta que sera heredada por las clases Libro, Pelicula y Disco
 */

abstract class Entidad
{
    private $id;
    private $titulo;

    private $anio;

    private $publicacion;

    private $imagen;

    private $genero;

    private $estado;

    /**
     * Constructor de la clase Entidad
     * @param int $id - Identificador
     * @param string $titulo - Titulo
     * @param int $anio - Año de creacion
     * @param string $publicacion - Publicacion
     * @param string $genero - Genero
     * @return void
     */

    // Encapsulamos los atributos de la clase
    public function __construct(int $id = 0, string $titulo = '',  DateTime $anio = null, string $publicacion = '', string $genero = '', string $imagen = '', bool $estado = true)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->anio = $anio;
        $this->publicacion = $publicacion;
        $this->genero = $genero;
        $this->imagen = $imagen;
        $this->estado = $estado;
    }
    /**
     * Metodos getters.
     */

    public final function getId(): int
    {
        return $this->id;
    }

    public final function getTitulo(): string
    {
        return $this->titulo;
    }

    public final function getAnio() 
    {
        return $this->anio;
    }

    
    public final function getPublicacion(): string
    {
        return $this->publicacion;
    }

    public final function getGenero(): string
    {
        return $this->genero;
    }
    public final function getImagen(): string
    {
        return $this->imagen;
    }

    public final function getEstado(): bool
    {
        return $this->estado;
    }

    /**
     * Metodos setters.
     */

    public final function setId(int $id): void
    {
        $this->id = $id;
    }

    public final function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public final function setAnio($anio): void
    {
        $this->anio = $anio;
    }

    public final function setPublicacion(string $publicacion): void
    {
        $this->publicacion = $publicacion;
    }

    public final function setGenero(string $genero): void
    {
        $this->genero = $genero;
    }

    public final function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public final function setEstado(bool $estado): void
    {
        $this->estado = $estado;
    }

    public function __toString(): string
    {
        return "Id: " . $this->id . " Titulo: " . $this->titulo . " Año: " . $this->anio->format('Y') . " Publicacion: " . $this->publicacion . " Genero: " . $this->genero;
    }

}

?>