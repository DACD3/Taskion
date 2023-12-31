<?php

class User
{
  private $id;
  private $name;
  private $username;
  private $email;
  private $password;
  private $avatar; // Este será un binario, generalmente usado para guardar imágenes o archivos en la base de datos.

  // Constructor
  public function __construct($id, $name, $username, $email, $password, $avatar)
  {
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->avatar = $avatar;
  }

  // Getters y setters
  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = password_hash($password, PASSWORD_BCRYPT);
  }

  public function getAvatar()
  {
    return $this->avatar;
  }

  public function setAvatar($avatar)
  {
    $this->avatar = $avatar;
  }

  public function __toString()
  {
    return "ID: {$this->id}, Nombre: {$this->name}, Usuario: {$this->username}, Email: {$this->email}, Avatar: {$this->avatar}";
  }
}
