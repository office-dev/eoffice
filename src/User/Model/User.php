<?php

namespace EOffice\User\Model;

use ApiPlatform\Core\Annotation\ApiResource;
use EOffice\Contracts\User\Model\UserInterface;

/**
 * @ApiResource()
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @var string
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected string $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $salt = null;
    protected array $roles;
    protected bool $enabled = true;
    protected ?string $plainPassword = null;

    /**
     * @param string $username
     * @param string $email
     * @param string|null $plainPassword
     * @param array $roles
     * @param bool $enabled
     */
    public function __construct(
        string $username,
        string $email,
        ?string $plainPassword = null,
        array $roles = [],
        bool $enabled = true
    ){
        $this->username = $username;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->roles = $roles;
        $this->enabled = $enabled;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }


    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
        return $this->id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
