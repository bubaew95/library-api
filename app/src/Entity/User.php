<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const STATUS_PASSWORD_UPDATE = 'password_update';
    const STATUS_ACTIVED         = 'actived';
    const STATUS_DEACTIVATED     = 'deactivated';
    const STATUS_BAN             = 'ban';

    const STATUSES = [
        self::STATUS_PASSWORD_UPDATE => 'Необходимо обновить пароль',
        self::STATUS_ACTIVED         => 'Активен',
        self::STATUS_DEACTIVATED     => 'Деактивирован',
        self::STATUS_BAN             => 'Заблокирован',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['registration'])]
    #[ORM\Column(length: 50)]
    private ?string $first_name;

    #[Assert\NotBlank(groups: ['registration'])]
    #[ORM\Column(length: 50)]
    private ?string $middle_name;

    #[Assert\NotBlank(groups: ['registration'])]
    #[ORM\Column(length: 50)]
    private ?string $last_name;

    #[Assert\NotBlank(message: "Поле {{ label }} не может быть пустым", groups: ["registration"])]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone;

    #[Assert\NotBlank(message: "Поле {{ label }} не может быть пустым", groups: ["registration"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $work_or_school;

    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $active;

    #[ORM\Column(length: 25, nullable: true)]
    private string $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(?string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getWorkOrSchool(): ?string
    {
        return $this->work_or_school;
    }

    public function setWorkOrSchool(?string $work_or_school): void
    {
        $this->work_or_school = $work_or_school;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
