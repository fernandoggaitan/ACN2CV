<?php

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function filter_password($password, $min_length = 8)
{
  // Verificar la longitud mínima
  if (strlen($password) < $min_length) {
    return null;
  }

  // Verificar que tenga al menos una letra minúscula
  if (!preg_match('/[a-z]/', $password)) {
    return null;
  }

  // Verificar que tenga al menos una letra mayúscula
  if (!preg_match('/[A-Z]/', $password)) {
    return null;
  }

  // Verificar que tenga al menos un número
  if (!preg_match('/[0-9]/', $password)) {
    return null;
  }

  // Verificar al menos un caracter especial (¡nuevo!)
  if (!preg_match('/[\W_]/', $password)) { // \W = no palabras (símbolos), _ = guión bajo
    return null;
  }

  // Si pasa todas las validaciones, retornar true
  return $password;
}
