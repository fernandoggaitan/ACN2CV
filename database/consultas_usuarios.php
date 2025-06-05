<?php

function getUsuarios(PDO $conexion)
{
    //Creamos la consulta.
    $consulta = $conexion->query('
        SELECT id, nombre, rol
        FROM usuarios
    ');
    //Traemos el resultado de la consulta.
    $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $usuarios;
}

function getUsuarioLogin(PDO $conexion, string $email)
{

    $consulta = $conexion->prepare('
        SELECT id, nombre, rol, contrasena
        FROM usuarios
        WHERE email = :email
    ');

    $consulta->bindValue(':email', $email);

    $consulta->execute();

    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    return $usuario;

}

function addUsuario( PDO $conexion, array $data )
{

    $consulta = $conexion->prepare('
        INSERT INTO usuarios(nombre, email, contrasena, cv, rol)
        VALUES(:nombre, :email, :contrasena, :cv, :rol)
    ');

    $consulta->bindValue(':nombre', $data['nombre']);
    $consulta->bindValue(':email', $data['email']);
    $consulta->bindValue(':contrasena', $data['contrasena']);
    $consulta->bindValue(':cv', $data['cv']);
    $consulta->bindValue(':rol', $data['rol']);

    $consulta->execute();


}