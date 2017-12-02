<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="order_number", type="string", length=255)
     */
    private $orderNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     * @Assert\NotBlank(groups={"buy"})
     * @Assert\Image(groups={"buy"})
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", options={"default":"1"})
     * @Assert\NotNull(groups={"set_status"})
     */
    private $status;

    /**
     * @ORM\Column(name="back_panel", type="string")
     */
    private $backPanel;

    /**
     * @ORM\Column(name="back_panel_price", type="decimal", precision=8, scale=0)
     */
    private $backPanelPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __sleep()
    {
        $ref   = new \ReflectionClass(__CLASS__);
        $props = $ref->getProperties(\ReflectionProperty::IS_PROTECTED);

        $serialize_fields = array();

        foreach ($props as $prop) {
            $serialize_fields[] = $prop->name;
        }

        return $serialize_fields;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param User $user
     * @return Orders
     * @internal param int $user
     *
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set orderNumber
     *
     * @param string $orderNumber
     *
     * @return Orders
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Orders
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Orders
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getReadableStatus()
    {
        if ($this->status == 1) {
            return 'Accepted';
        } elseif ($this->status == 2) {
            return 'Shipped';
        } else {
            return 'Fulfilled';
        }
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $createdAt;
    }

    /**
     * Get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getBackPanel()
    {
        return $this->backPanel;
    }

    /**
     * @param mixed $backPanel
     */
    public function setBackPanel($backPanel)
    {
        $this->backPanel = $backPanel;
    }

    /**
     * @return mixed
     */
    public function getBackPanelPrice()
    {
        return $this->backPanelPrice;
    }

    /**
     * @param mixed $backPanel
     * @return float
     */
    public function setBackPanelPrice($backPanel)
    {
        if ($backPanel == 'metal') {
            $this->backPanelPrice = '50.00';
        } elseif ($backPanel == 'glass') {
            $this->backPanelPrice = '100.00';
        } else {
            $this->backPanelPrice = 0;
        }

        return $this->backPanelPrice;
    }

}

